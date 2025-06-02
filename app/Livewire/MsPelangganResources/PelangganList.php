<?php

namespace App\Livewire\MsPelangganResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\MsPelanggan;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;
use App\Exports\PelanggansExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PelangganList extends Component
{

  public string $title = "Pelanggan";
  public string $url = "/pelanggan";

  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public bool $filterDrawer;
  public $exportFilter;

  public array $sortBy = ['column' => 'nama', 'direction' => 'desc'];

  #[Url(except: '')]
  public array $filters = [];
  public array $filterForm = [
    'nama' => '',
    'no_telp' => '',
    'alamat' => '',
    'email' => '',
    'nomor' => '',
    'dibuat_oleh' => '',
    'diupdate_oleh' => '',
    'tgl_dibuat' => '',
    'tgl_diupdate' => '',
  ];


  public function mount() {}

  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'nomor', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'nama', 'label' => 'Nama', 'sortBy' => 'nama', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'no_telp', 'label' => 'No Telepon', 'sortBy' => 'no_telp', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'alamat', 'label' => 'alamat', 'sortBy' => 'alamat',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'email', 'label' => 'Email', 'sortBy' => 'email',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'dibuat_oleh', 'label' => 'Dibuat Oleh', 'sortBy' => 'dibuat_oleh',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'diupdate_oleh', 'label' => 'Diupdate Oleh', 'sortBy' => 'diupdate_oleh',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'tgl_dibuat', 'label' => 'Tanggal Dibuat', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'tgl_dibuat', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'tgl_diupdate', 'label' => 'Tanggal Diupdate', 'sortBy' => 'tgl_diupdate', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'status', 'label' => 'Activate', 'sortBy' => 'status', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
    ];
  }



  #[Computed]
  public function rows(): LengthAwarePaginator
  {

    $query = MsPelanggan::query();

    $query->when($this->search, fn($q) => $q->where('nama', 'like', "%{$this->search}%"))
      ->when(($this->filters['nama'] ?? ''), fn($q) => $q->where('nama', 'like', "%{$this->filters['nama']}%"))
      ->when(($this->filters['no_telp'] ?? ''), fn($q) => $q->where('no_telp', 'like', "%{$this->filters['no_telp']}%"))
      ->when(($this->filters['alamat'] ?? ''), fn($q) => $q->where('alamat', 'like', "%{$this->filters['alamat']}%"))
      ->when(($this->filters['email'] ?? ''), fn($q) => $q->where('email', 'like', "%{$this->filters['email']}%"))
      ->when(($this->filters['dibuat_oleh'] ?? ''), fn($q) => $q->where('dibuat_oleh', 'like', "%{$this->filters['dibuat_oleh']}%"))
      ->when(($this->filters['diupdate_oleh'] ?? ''), fn($q) => $q->where('diupdate_oleh', 'like', "%{$this->filters['dibuat_oleh']}%"))
      ->when((($this->filters['status'] ?? '') != ''), fn($q) => $q->where('status', $this->filters['status']))
      ->when(($this->filters['tgl_dibuat'] ?? ''), function ($q) {
        $dateTime = $this->filters['tgl_dibuat'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('tgl_dibuat', $dateOnly);
      })
      ->when(($this->filters['tgl_diupdate'] ?? ''), function ($q) {
        $dateTime = $this->filters['tgl_diupdate'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('tgl_diupdate', $dateOnly);
      });

    $this->exportFilter = $query->get();

    $paginator = $query
      ->orderBy(...array_values($this->sortBy))
      ->paginate(20);

    $start = ($paginator->currentPage() - 1) * $paginator->perPage();

    $paginator->getCollection()->transform(function ($item, $key) use ($start) {
      $item->no_urut = $start + $key + 1;
      return $item;
    });

    return $paginator;
  }

  public function filter()
  {
    $validatedFilters = $this->validate(
      [
        'filterForm.nama' => 'nullable|string',
        'filterForm.no_telp' => 'nullable|string',
        'filterForm.alamat' => 'nullable|string',
        'filterForm.email' => 'nullable|string',
        'filterForm.dibuat_oleh' => 'nullable|string',
        'filterForm.diupdate_oleh' => 'nullable|string',
        'filterForm.status' => 'nullable|integer',
        'filterForm.tgl_dibuat' => 'nullable|string',
        'filterForm.tgl_diupdate' => 'nullable|string',
      ],
      [],
      [
        'filterForm.nama' => 'Nama',
        'filterForm.no_telp' => 'No Telepon',
        'filterForm.alamat' => 'alamat',
        'filterForm.email' => 'Email',
        'filterForm.dibuat_oleh' => 'Dibuat Oleh',
        'filterForm.diupdate_oleh' => 'Diupdate Oleh',
        'filterForm.status' => 'Status',
        'filterForm.tgl_dibuat' => 'Tanggal Dibuat',
        'filterForm.tgl_diupdate' => 'Tanggal Diupdate',
      ]
    )['filterForm'];



    $this->filters = collect($validatedFilters)->reject(fn($value) => $value === '')->toArray();
    $this->success('Filter Result');
    $this->filterDrawer = false;
  }


  // public function export()
  // {
  //   $timestamp = Carbon::now()->format('Ymd-His');
  //   return Excel::download(new CustomersExport($this->exportFilter), 'customers-' . $timestamp . '.xlsx');
  // }



  public function render()
  {
    return view('livewire.pelanggan-resources.pelanggan-list')
      ->title($this->title);
  }
}
