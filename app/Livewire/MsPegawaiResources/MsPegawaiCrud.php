<?php

namespace App\Livewire\MsPegawaiResources;

use App\Livewire\PegawaiResources\Forms\PegawaiForm;
use Livewire\Component;
use App\Models\PegawaiBrand;
use App\Models\Pegawai;
use App\Models\PegawaiCategoryFirst;
use App\Models\MsPegawai;
use App\Helpers\Permission\Traits\WithPermission;

class MsPegawaiCrud extends Component
{

  public function render()
  {
    return view('livewire.pegawai-resources.pegawai-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \Mary\Traits\Toast;
  use WithPermission;

  #[\Livewire\Attributes\Locked]
  public string $title = 'Pegawai';

  public  $brands = [];

  public $selectedBrandId = '';
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
  protected $masterModel = \App\Models\MsPegawai::class;

  public PegawaiForm $masterForm;

  public function mount()
  {


    if ($this->id && $this->readonly) {
      $this->title .= ' (Tampil)';
      $this->show();
    } else if ($this->id) {
      $this->title .= ' (Ubah)';
      $this->edit();
    } else {
      $this->title .= ' (Buat)';
      $this->buat();
    }

    $this->initialize();
  }


  public function initialize() {}

  public function buat()
  {

    $this->permission('pegawai-buat');
    $this->masterForm->reset();
  }

  public function store()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];


    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['created_by'] = 'admin';
      $validatedForm['updated_by'] = 'admin';
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

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();
      $this->redirect('/products', true);
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data product failed to store: ' . $th->getMessage());

      $this->error('Data failed to store');
    }
  }

  public function show()
  {
    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {
    $this->isReadonly = false;
    $this->isDisabled = false;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];
    $masterData = $this->masterModel::findOrFail($this->id);

    try {

      $validatedForm['updated_by'] = auth()->user()->username ?? null;

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
    $masterData = $this->masterModel::findOrFail($this->id);

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


  // Hook
  public function updatedMasterFormSellingPrice()
  {
    try {
      $this->masterForm->discount_value = $this->masterForm->selling_price * $this->masterForm->discount_persentage / 100;
      $this->masterForm->nett_price = $this->masterForm->selling_price - $this->masterForm->discount_value;
    } catch (\Throwable $th) {
      $this->masterForm->discount_persentage = 0;
      $this->masterForm->discount_value = 0;
      $this->masterForm->nett_price = $this->masterForm->selling_price;
    }
  }

  public function updatedMasterFormDiscountPersentage()
  {
    try {
      $this->masterForm->discount_value = $this->masterForm->selling_price * $this->masterForm->discount_persentage / 100;
      $this->masterForm->nett_price = $this->masterForm->selling_price - $this->masterForm->discount_value;
    } catch (\Throwable $th) {
      $this->masterForm->discount_persentage = 0;
      $this->masterForm->discount_value = 0;
      $this->masterForm->nett_price = $this->masterForm->selling_price;
    }
  }

  public function updatedMasterFormDiscountValue()
  {

    try {
      $this->masterForm->discount_persentage = ($this->masterForm->discount_value / $this->masterForm->selling_price) * 100;
      $this->masterForm->discount_persentage = number_format($this->masterForm->discount_persentage, 2);
      $this->masterForm->nett_price = $this->masterForm->selling_price - $this->masterForm->discount_value;
    } catch (\Throwable $th) {
      $this->masterForm->discount_persentage = 0;
      $this->masterForm->discount_value = 0;
      $this->masterForm->nett_price = $this->masterForm->selling_price;
    }
  }

  public function updatedMasterFormNettPrice()
  {
    try {
      $this->masterForm->discount_value = $this->masterForm->selling_price - $this->masterForm->nett_price;
      $this->masterForm->discount_persentage = ($this->masterForm->discount_value / $this->masterForm->selling_price) * 100;
      $this->masterForm->discount_persentage = number_format($this->masterForm->discount_persentage, 2);
    } catch (\Throwable $th) {
      $this->masterForm->discount_persentage = 0;
      $this->masterForm->discount_value = 0;
      $this->masterForm->nett_price = $this->masterForm->selling_price;
    }
  }
  // ./Hook



}
