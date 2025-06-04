<?php

namespace App\Livewire\MsAksiResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Admin;
use App\Models\RoleHasPermission;
use App\Models\MsAksi;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Livewire\ProductResources\Forms\ProductForm;
use Mary\Traits\Toast;
use App\Helpers\Permission\Traits\WithPermission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class MsAksiList extends Component
{

  public string $title = "Aksi";
  public string $url = "/Aksi";


  use WithPermission;


  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public bool $filterDrawer;

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


  public function mount()
  {
    $this->permission('aksi-list');
  }

  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'nomor', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'nama', 'label' => 'Nama', 'sortBy' => 'nama', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'tgl_dibuat', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'tgl_dibuat', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
    ];
  }

  #[Computed]
  public function rows(): LengthAwarePaginator
  {

    $query = MsAksi::query();

    $query->when($this->search, fn($q) => $q->where('nama', 'like', "%{$this->search}%"))
      ->when(($this->filters['nama'] ?? ''), fn($q) => $q->where('nama', 'like', "%{$this->filters['nama']}%"))
      ->when(($this->filters['nomor'] ?? ''), fn($q) => $q->where('nomor', 'like', "%{$this->filters['nomor']}%"))
      ->when(($this->filters['tgl_dibuat'] ?? ''), function ($q) {
        $dateTime = $this->filters['tgl_dibuat'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('tgl_dibuat', $dateOnly);
      });

    $paginator = $query
      ->orderBy('nomor', 'asc')
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
        'filterForm.nama' => 'nullable|string',
        'filterForm.status' => 'nullable|integer',
        'filterForm.tgl_dibuat' => 'nullable|string',
      ],
      [],
      [
        'filterForm.nama' => 'Nama',
        'filterForm.status' => 'Status',
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

  public function delete()
  {
    $masterData = MsAksi::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $this->deleteImage($masterData['image_url']);

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
    return view('livewire.aksi-resources.aksi-list')
      ->title($this->title);
  }
}
