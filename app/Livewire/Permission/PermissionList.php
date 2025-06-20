<?php

namespace App\Livewire\Permission;

use App\Models\MsAksi;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Admin;
use App\Models\RoleHasPermission;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Livewire\ProductResources\Forms\ProductForm;
use Mary\Traits\Toast;
use App\Helpers\Permission\Traits\WithPermission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class PermissionList extends Component
{

  public string $title = "Permission";
  public string $url = "/permission";

  use WithPermission;

  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public bool $filterDrawer;

  public array $sortBy = ['column' => 'name', 'direction' => 'desc'];

  #[Url(except: '')]
  public array $filters = [];
  public array $filterForm = [
    'name' => '',
    'guard_name' => '',
    'created_at' => '',
    'updated_at' => '',
  ];


  public function mount()
  {
    $this->cekDanBuatPermissions();
    // $this->permission('permission-list');
  }

  public function cekDanBuatPermissions(): void
  {
    $actions = MsAksi::pluck('nama')->toArray(); // Contoh: ['list', 'buat', 'simpan', 'ubah', 'hapus', ...]
    $permissions = Permission::pluck('name')->toArray();

    // Kelompokkan permission yang sudah ada berdasarkan nama halaman (prefix)
    $grouped = [];

    foreach ($permissions as $perm) {
      if (str_contains($perm, '-')) {
        [$halaman, $aksi] = explode('-', $perm, 2);
        $grouped[$halaman][] = $aksi;
      }
    }

    $existingHalaman = array_keys($grouped);


    foreach ($existingHalaman as $halaman) {
      $existingAksi = $grouped[$halaman] ?? [];
      $missing = array_diff($actions, $existingAksi);

      foreach ($missing as $aksi) {
        $permissionName = "{$halaman}-{$aksi}";
        Permission::firstOrCreate([
          'name' => $permissionName,
          'guard_name' => 'web'
        ]);
        logger("✅ Permission dibuat: $permissionName");
      }
    }
  }


  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'no_urut', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'name', 'label' => 'Name', 'sortBy' => 'name', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'created_at', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'created_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'updated_at', 'label' => 'Updated At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'updated_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
    ];
  }

  #[Computed]
  public function rows(): LengthAwarePaginator
  {

    $query = Permission::query();

    $query->when(
      $this->search,
      fn($q) =>
      $q->where('name', 'like', "%{$this->search}%")
    )
      ->when(($this->filters['name'] ?? ''),
        fn($q) =>
        $q->where('name', 'like', "%{$this->filters['name']}%")
      )
      ->when(($this->filters['guard_name'] ?? ''),
        fn($q) =>
        $q->where('guard_name', 'like', "%{$this->filters['guard_name']}%")
      )
      ->when(($this->filters['updated_at'] ?? ''), function ($q) {
        $dateTime = $this->filters['updated_at'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('updated_at', $dateOnly);
      })
      ->when(($this->filters['created_at'] ?? ''), function ($q) {
        $dateTime = $this->filters['created_at'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('created_at', $dateOnly);
      });


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
        'filterForm.name' => 'nullable|string',
        'filterForm.status' => 'nullable|integer',
        'filterForm.tgl_dibuat' => 'nullable|string',
      ],
      [],
      [
        'filterForm.name' => 'Name',
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
    $masterData = Permission::findOrFail($this->id);

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
    return view('livewire.permission-resources.permission-list')
      ->title($this->title);
  }
}
