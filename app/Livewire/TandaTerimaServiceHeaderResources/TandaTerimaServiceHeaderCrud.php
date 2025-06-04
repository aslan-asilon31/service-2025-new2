<?php

namespace App\Livewire\TandaTerimaServiceHeaderResources;

use App\Livewire\TandaTerimaServiceHeaderResources\Forms\TandaTerimaServiceHeaderForm;
use Livewire\Component;
use App\Models\MsPegawai;
use App\Models\TrTandaTerimaServiceHeader;
use App\Models\ProductBrand;
use App\Models\Product;
use App\Models\ProductCategoryFirst;
use App\Helpers\Permission\Traits\WithPermission;
use Illuminate\Support\Facades\DB;

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

  #[\Livewire\Attributes\Locked]
  public string $title = 'Tanda Terima Service ';

  public  $brands = [];

  public $selectedBrandId = '';
  public $details = [];
  public $selectedProductCategoryFirstId = '';
  public  $productCategoryFirsts = [];
  public  $productCategories = [];

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


  public TandaTerimaServiceHeaderForm $masterForm;

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


  public function initialize() {}



  public function simpan()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];


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
    $this->masterForm->reset();

    $nomorTerakhir = \Illuminate\Support\Facades\DB::table('ms_barang')->max('nomor') ?? 0;
    $this->masterForm->nomor = $nomorTerakhir + 1;


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

  public function tampil()
  {
    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->headerModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function ubah()
  {
    $this->permission('tanda-terima-service-ubah');

    $this->isReadonly = false;
    $this->isDisabled = false;
    $masterData = $this->headerModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];
    $masterData = $this->headerModel::findOrFail($this->id);

    try {

      $validatedForm['diupdate_oleh'] = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->nama ?? null;

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

      $masterData->update($validatedForm);
      $this->redirect('/products', true);


      $this->success('Data has been updated');
    } catch (\Throwable $e) {
      \Log::error('Data failed : ' . $e->getMessage());

      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
    }
  }

  public function delete()
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
}
