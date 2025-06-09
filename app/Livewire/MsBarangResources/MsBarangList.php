<?php

namespace App\Livewire\MsBarangResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Admin;
use App\Models\RoleHasPermission;
use App\Models\MsBarang;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Livewire\ProductResources\Forms\ProductForm;
use Mary\Traits\Toast;
use App\Helpers\Permission\Traits\WithPermission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7\Request;

class MsBarangList extends Component
{

  public string $title = "Barang";
  public string $url = "/barang";


  use WithPermission;


  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public bool $filterDrawer;

  public array $sortBy = ['column' => 'title', 'direction' => 'desc'];

  #[Url(except: '')]
  public array $filters = [];
  public array $filterForm = [
    'title' => '',
    'price' => 0,
    'description' => '',
    'category' => '',
    'is_activated' => '',
    'tgl_dibuat' => '',
  ];


  public function mount()
  {
    $this->permission('barang-list');
  }

  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'nomor', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'title', 'label' => 'title', 'sortBy' => 'title', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'price', 'label' => 'price', 'sortBy' => 'price', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'description', 'label' => 'description', 'sortBy' => 'description', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'category', 'label' => 'category', 'sortBy' => 'category', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'image', 'label' => 'image', 'sortBy' => 'image', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],

      ['key' => 'tgl_dibuat', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'tgl_dibuat', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
    ];
  }

  #[Computed]
  public function rows(): LengthAwarePaginator
  {

    $client = new \GuzzleHttp\Client([
      'verify' => false
    ]);

    $response = $client->get('https://fakestoreapi.com/products');
    $dataModel = json_decode($response->getBody(), true);

    $barangCollection = collect($dataModel)->map(function ($productData) {
      return [
        'id' => $productData['id'],
        'title' => $productData['title'],
        'price' => $productData['price'],
        'description' => $productData['description'],
        'category' => $productData['category'],
        'image' => $productData['image'],
        'rating_rate' => $productData['rating']['rate'],
        'rating_count' => $productData['rating']['count'],
        'created_at' => now(),
        'updated_at' => now(),
      ];
    });


    $filteredData = $barangCollection->when($this->search, function ($collection) {
      return $collection->filter(function ($product) {
        // Periksa apakah key 'title' ada sebelum mencoba mengaksesnya
        return isset($product['title']) && stripos($product['title'], $this->search) !== false;
      });
    })->when($this->filters['title'] ?? '', function ($collection) {
      return $collection->filter(function ($product) {
        // Periksa apakah key 'title' ada sebelum mencoba mengaksesnya
        return isset($product['title']) && stripos($product['title'], $this->filters['title']) !== false;
      });
    })->when($this->filters['price'] ?? '', function ($collection) {
      return $collection->filter(function ($product) {
        // Periksa apakah key 'price' ada sebelum mencoba mengaksesnya
        return isset($product['price']) && stripos((string) $product['price'], $this->filters['price']) !== false;
      });
    })->when($this->filters['description'] ?? '', function ($collection) {
      return $collection->filter(function ($product) {
        // Periksa apakah key 'description' ada sebelum mencoba mengaksesnya
        return isset($product['description']) && stripos($product['description'], $this->filters['description']) !== false;
      });
    })->when($this->filters['category'] ?? '', function ($collection) {
      return $collection->filter(function ($product) {
        // Periksa apakah key 'category' ada sebelum mencoba mengaksesnya
        return isset($product['category']) && stripos($product['category'], $this->filters['category']) !== false;
      });
    });

    // Paginasi data collection
    $perPage = 20;  // Jumlah data per halaman
    $page = request()->get('page', 1);  // Halaman saat ini

    $paginator = new LengthAwarePaginator(
      $filteredData->forPage($page, $perPage),
      $filteredData->count(),
      $perPage,
      $page,
      ['path' => url()->current()]
    );

    // Kembalikan data paginasi
    return $paginator;
  }

  // #[Computed]
  // public function rows(): LengthAwarePaginator
  // {

  //   $query = MsBarang::query();

  //   $query->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
  //     ->when(($this->filters['title'] ?? ''), fn($q) => $q->where('title', 'like', "%{$this->filters['title']}%"))
  //     ->when(($this->filters['nomor'] ?? ''), fn($q) => $q->where('nomor', 'like', "%{$this->filters['nomor']}%"))
  //     ->when(($this->filters['tgl_dibuat'] ?? ''), function ($q) {
  //       $dateTime = $this->filters['tgl_dibuat'];
  //       $dateOnly = substr($dateTime, 0, 10);
  //       $q->whereDate('tgl_dibuat', $dateOnly);
  //     });

  //   $paginator = $query
  //     ->orderBy('nomor', 'asc')
  //     ->paginate(20);

  //   $start = ($paginator->currentPage() - 1) * $paginator->perPage();

  //   $paginator->getCollection()->transform(function ($item, $key) use ($start) {
  //     return $item;
  //   });

  //   return $paginator;
  // }

  public function filter()
  {
    $validatedFilters = $this->validate(
      [
        'filterForm.title' => 'nullable|string',
        'filterForm.price' => 'nullable|integer',
        'filterForm.description' => 'nullable|string',
        'filterForm.category' => 'nullable|string',
        'filterForm.image' => 'nullable|string',
      ],
      [],
      [
        'filterForm.title' => 'title',
        'filterForm.price' => 'Status',
        'filterForm.description' => 'Description',
        'filterForm.category' => 'Category',
        'filterForm.image' => 'Image',
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
    $masterData = MsBarang::findOrFail($this->id);

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
    return view('livewire.barang-resources.barang-list')
      ->title($this->title);
  }
}
