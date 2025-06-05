<?php

namespace App\Livewire\TandaTerimaServiceDetailResources;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Models\TrTandaTerimaServiceDetail;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Livewire\ProductResources\Forms\ProductForm;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Permission\Traits\WithPermission;
use Livewire\Attributes\On;

class TandaTerimaServiceDetailList extends Component
{

  public string $title = "Tanda Terima Service Detail List";
  public string $url = "/tanda-terima-service";


  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;
  use WithPermission;


  #[Url(except: '')]
  public ?string $search = '';

  public bool $filterDrawer;
  public $TandaTerimaServiceHeaderId;

  public array $sortBy = ['column' => 'nama', 'direction' => 'desc'];

  #[Url(except: '')]
  public array $filters = [];
  public array $filterForm = [
    'nama' => '',
    'selling_price' => '',
    'image_url' => '',
    'is_activated' => '',
    'tgl_dibuat' => '',
  ];

  #[\Livewire\Attributes\Locked]
  protected $detailModel = \App\Models\TrTandaTerimaServiceDetail::class;

  public $modalDetail = false;
  public $detailId = null;
  public int $detailIndex;

  public function mount()
  {
    $this->permission('tanda-terima-service-list');
  }

  public function fetchIdFromHeader() {}

  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'nomor', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'tr_tanda_terima_service_header_id', 'label' => 'Tanda Terima Service Header ID', 'sortBy' => 'tr_tanda_terima_service_header_id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'ms_barang_id', 'label' => 'Barang ID', 'sortBy' => 'ms_barang_id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'ms_rak_id', 'label' => 'Rak ID', 'sortBy' => 'ms_rak_id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'catatan', 'label' => 'Catatan', 'sortBy' => 'catatan', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'qty', 'label' => 'Quantity', 'sortBy' => 'qty', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'status', 'label' => 'Status', 'sortBy' => 'status', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'tgl_dibuat', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'tgl_dibuat', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
    ];
  }

  #[Computed]
  public function rows(): LengthAwarePaginator
  {

    $query = TrTandaTerimaServiceDetail::query();
    $query->when($this->search, fn($q) => $q->where('id', 'like', "%{$this->search}%"))
      ->when(($this->filters['id'] ?? ''), fn($q) => $q->where('id', 'like', "%{$this->filters['tr_tanda_terima_service_header_id']}%"))
      ->when(($this->filters['tr_tanda_terima_service_header_id'] ?? ''), fn($q) => $q->where('tr_tanda_terima_service_header_id', 'like', "%{$this->filters['tr_tanda_terima_service_header_id']}%"))
      ->when(($this->filters['ms_barang_id'] ?? ''), fn($q) => $q->where('ms_barang_id', 'like', "%{$this->filters['ms_barang_id']}%"))
      ->when(($this->filters['ms_rak_id'] ?? ''), fn($q) => $q->where('ms_rak_id', 'like', "%{$this->filters['ms_rak_id']}%"))
      ->when(($this->filters['catatan'] ?? ''), fn($q) => $q->where('catatan', 'like', "%{$this->filters['catatan']}%"))
      ->when(($this->filters['qty'] ?? ''), fn($q) => $q->where('qty', $this->filters['qty']))
      ->when(($this->filters['tgl_dibuat'] ?? ''), function ($q) {
        $dateTime = $this->filters['tgl_dibuat'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('tgl_dibuat', $dateOnly);
      });

    $paginator = $query
      // ->orderBy('nomor', 'asc')
      ->where('tr_tanda_terima_service_header_id', session('TandaTerimaServiceHeaderId'))
      ->paginate(20);

    $start = ($paginator->currentPage() - 1) * $paginator->perPage();

    $paginator->getCollection()->transform(function ($item, $key) use ($start) {
      return $item;
    });

    return $paginator;
  }

  public function filter()
  {
    $validatedFilters = $this->validate(
      [
        'filterForm.tr_tanda_terima_service_id' => 'nullable|string',
        'filterForm.ms_barang_id' => 'nullable|integer',
        'filterForm.ms_rak_id' => 'nullable|integer',
        'filterForm.tgl_dibuat' => 'nullable|string',
      ],
      [],
      [
        'filterForm.tr_tanda_terima_service_id' => 'Tanda Terima Service ID',
        'filterForm.ms_barang_id' => 'Barang ID',
        'filterForm.ms_rak_id' => 'Rak ID',
        'filterForm.tgl_dibuat' => 'Tanggal Dibuat',
      ]
    )['filterForm'];

    $this->filters = collect($validatedFilters)->reject(fn($value) => $value === '')->toArray();
    $this->success('Filter Result');
    $this->filterDrawer = false;
  }

  public function clear(): void
  {
    $this->reset('filters');
    $this->reset('filterForm');
    $this->success('filter cleared');
  }

  public function hapus()
  {
    $masterData = TrTandaTerimaServiceDetail::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect($this->url, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }





  public function render()
  {
    return view('livewire.tanda-terima-service-detail-resources.tanda-terima-service-detail-list')
      ->title($this->title);
  }
}
