<?php

namespace App\Livewire\TandaTerimaServiceHeaderResources;

use App\Livewire\TandaTerimaServiceHeaderResources\Forms\TandaTerimaServiceHeaderForm;
use App\Livewire\TandaTerimaServiceHeaderResources\Forms\TandaTerimaServiceDetailForm;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\TrTandaTerimaServiceDetail;
use App\Models\MsPegawai;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\Permission\Traits\WithPermission;
use App\Helpers\FormHook\Traits\WithTandaTerimaService;
use App\Models\TrTandaTerimaServiceHeader;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;

class TandaTerimaServiceHeaderCrud extends Component
{

  public function render()
  {
    return view('livewire.tanda-terima-service-header-resources.tanda-terima-service-header-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \Mary\Traits\Toast;
  use WithPermission;
  use WithTandaTerimaService;

  public \Illuminate\Support\Collection $pelangganSearchable;


  #[\Livewire\Attributes\Locked]
  public string $title = 'Tanda Terima Service ';


  #[Url(except: '')]
  public ?string $search = '';

  public  $brands = [];

  public $selectedBrandId = '';
  public $details = [];
  public $selectedProductCategoryFirstId = '';
  public $productCategoryFirsts = [];
  public $productCategories = [];
  public $header;
  public $halaman = 'tanda-terima-service';
  public $cabang;
  public $detailId = null;

  #[\Livewire\Attributes\Locked]
  public string $url = '/products';

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/products';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'product_image';

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $headerModel = \App\Models\TrTandaTerimaServiceHeader::class;

  #[\Livewire\Attributes\Locked]
  protected $detailModel = \App\Models\TrTandaTerimaServiceDetail::class;


  // #[\Livewire\Attributes\Session]
  // public $search;

  public TandaTerimaServiceHeaderForm $headerForm;
  public TandaTerimaServiceDetailForm $detailForm;

  public function mount()
  {

    if ($this->id && $this->readonly) {
      $this->title .= ' (Tampil)';
      $this->tampil();
    } else if ($this->id) {
      $this->title .= ' (Ubah)';
      $this->ubah();
    } else {
      $this->title .= ' (Buat)';
      $this->buat();
    }

    $this->initialize();
  }


  public function initialize()
  {
    session()->put('TandaTerimaServiceHeaderId', $this->id);
  }

  public function simpan()
  {
    $validatedForm = $this->validate(
      $this->headerForm->rules(),
      [],
      $this->headerForm->attributes()
    )['headerForm'];


    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['dibuat_oleh'] = 'admin';
      $validatedForm['diupdate_oleh'] = 'admin';
      $validatedForm['is_activated'] = 1;
      // image_url
      $folderName = $this->baseFolderName;
      $now = now()->format('Ymd_His_u');
      $imageName = $this->baseImageName . '_' . str($validatedForm['name'])->slug('_')  . '_' . 'image' . '_' . $now;
      $newImageUrl = $validatedForm['image_url'];

      $validatedForm['image_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
      );
      // ./image_url

      $this->headerModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();
      $this->redirect('/products', true);
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data product failed to store: ' . $th->getMessage());

      $this->error('Data failed to store');
    }
  }

  public function buat()
  {
    $this->permission('tanda-terima-service-buat');
    $this->headerForm->reset();

    $nomorTerakhir = \Illuminate\Support\Facades\DB::table('ms_barang')->max('nomor') ?? 0;
    $this->headerForm->nomor = $nomorTerakhir + 1;

    // ----------------------------------------------------------------

    $user = \Illuminate\Support\Facades\Auth::guard('pegawai')->user();

    $pegawaiAksesCabang = \Illuminate\Support\Facades\DB::table('pegawai_akses_cabang as pac')
      ->join('ms_cabang as mc', 'pac.ms_cabang_id', '=', 'mc.id')
      ->where('pac.ms_pegawai_id', $user->id)
      ->select('mc.*')
      ->get()->toArray();

    $cabangId = $pegawaiAksesCabang[0]->id;

    $pegawaiAksesCabangGudang = \Illuminate\Support\Facades\DB::table('ms_gudang')
      ->join('ms_rak', 'ms_rak.ms_gudang_id', '=', 'ms_gudang.id')
      ->where('ms_gudang.ms_cabang_id', $cabangId)
      ->select('ms_gudang.*')
      ->get();

    $gudangId = $pegawaiAksesCabangGudang;
    // $gudangId = $pegawaiAksesCabangGudang->pluck('id');

    dd($gudangId);

    $pegawaiAksesCabangGudangRak = DB::table('ms_rak as rak')
      ->join('ms_gudang as gudang', 'rak.ms_gudang_id', '=', 'gudang.id')
      ->whereIn('rak.ms_gudang_id', $gudangId)
      ->select('rak.*')
      ->get();

    dd($pegawaiAksesCabangGudangRak);

    $rakIds = $pegawaiAksesCabangGudangRak;



    $pegawaiAksesCabangRak = \Illuminate\Support\Facades\DB::table('ms_gudang')
      ->join('ms_rak', 'ms_rak.ms_gudang_id', '=', 'ms_gudang.id')
      ->where('ms_gudang.id', $cabangId)
      ->select('ms_gudang.*')
      ->get()->toArray();
    dd($pegawaiAksesCabangRak);

    $pegawaiAksesCabang = \Illuminate\Support\Facades\DB::table('pegawai_akses_cabang as pac')
      ->join('ms_cabang as mc', 'pac.ms_cabang_id', '=', 'mc.id')
      ->where('pac.ms_pegawai_id', $user->id)
      ->select('mc.*')
      ->get()->toArray();

    $details = collect($this->details)
      ->map(function ($detail, $index) use ($header) {
        return [
          'id' => str()->orderedUuid()->toString(),
          'sales_order_id' => $header->id,
          'product_id' => $detail['product_id'],
          'selling_price' => $detail['selling_price'],
          'qty' => $detail['qty'],
        ];
      })
      ->toArray();

    $this->details = $details;
  }

  public function buatDetail()
  {
    $this->detailForm->reset();
    $this->bukaModal();
  }

  public function ubahDetail($detailIndex)
  {
    $this->isReadonly = false;
    $this->isDisabled = false;
    $masterData = $this->detailModel::findOrFail($detailIndex);
    $this->detailForm->fill($masterData);
    $this->modalDetail = true;
  }

  public function tampil()
  {
    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->headerModel::findOrFail($this->id);
    $this->headerForm->fill($masterData);
  }

  public function ubah()
  {
    $this->permission('tanda-terima-service-ubah');
    $this->isReadonly = false;
    $this->isDisabled = false;
    $masterData = $this->headerModel::findOrFail($this->id);
    $this->headerForm->fill($masterData);
  }

  public function update()
  {

    $validatedHeaderForm = $this->validate(
      $this->headerForm->rules(),
      [],
      $this->headerForm->attributes()
    )['headerForm'];

    $this->header = $this->headerModel::findOrFail($this->id);
    $this->halaman = 'servis';
    $this->cabang = 'CBG01';
    $userCabang = MsPegawai::with('pegawaiAksesCabang.msCabangs')->find(auth('pegawai')->user()->id);

    dd($userCabang);
    \Illuminate\Support\Facades\Gate::authorize('update', [$this->header, $this->halaman, 'cabang', 'status']);
    dd('stop');
    // $this->authorize('updateStatus', [$this->header, $validatedHeaderForm['status']]);

    $masterData = $this->headerModel::findOrFail($this->id);
    try {
      $validatedForm['diupdate_oleh'] = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->nama ?? null;

      $masterData->update($validatedForm);
      $this->redirect('/products', true);

      $this->success('Data has been updated');
    } catch (\Throwable $e) {
      \Log::error('Data failed : ' . $e->getMessage());

      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
    }
  }

  public function hapus()
  {
    $masterData = $this->headerModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $this->deleteImage($masterData['image_url']);

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();
      $this->redirect('/products', true);

      $this->success('Data has been deleted');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }

  public array $sortBy = ['column' => 'nama', 'direction' => 'desc'];

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
      ->when(($this->filters['id'] ?? ''), fn($q) => $q->where('id', 'like', "%{$this->filters['id']}%"))
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

  public function searchPelanggan(string $value = '')
  {
    $selectedOption = \App\Models\MsPelanggan::where('id', $this->headerForm->ms_pelanggan_id)->get();

    $this->pelangganSearchable = \App\Models\MsPelanggan::query()
      ->where('nama', 'like', "%$value%")
      ->orderBy('tgl_dibuat')
      ->get()
      ->merge($selectedOption);
  }
}
