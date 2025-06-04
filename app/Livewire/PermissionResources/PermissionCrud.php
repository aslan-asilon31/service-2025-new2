<?php

namespace App\Livewire\PermissionResources;

use App\Livewire\PermissionResources\Forms\PermissionForm;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Position;
use Livewire\Component;

class PermissionCrud extends Component
{
  public function render()
  {
    return view('livewire.permission-resources.permission-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\Permission\Traits\WithPermission;
  use \Mary\Traits\Toast;

  public $pages = [];
  public $position = [];
  public $permissions = [];
  public $isLoading = false;

  #[\Livewire\Attributes\Locked]
  public string $title = 'Permission';

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'permission';

  #[\Livewire\Attributes\Locked]
  public string $url = '/permissions';


  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'permission_image';

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
  protected $masterModel = \App\Models\Permission::class;
  protected $masterPermissionModel = \App\Models\Permission::class;

  public PermissionForm $masterForm;

  public function mount()
  {
    if ($this->id && $this->readonly) {
      $this->title .= ' (Show)';
      $this->show();
    } else if ($this->id) {
      $this->title .= ' (Edit)';
      $this->edit();
    } else {
      $this->title .= ' (Create)';
      $this->create();
    }
    $this->initialize();
  }

  public function initialize() {}

  public function create()
  {
    $this->permission($this->basePageName . '-create');
    $this->masterForm->reset();
  }

  public function store()
  {
    $this->permission($this->basePageName . '-create');
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];


    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['id'] = str($validatedForm['name'])->slug('_');

      $validatedForm['created_by'] = auth()->user()->username;
      $validatedForm['updated_by'] = auth()->user()->username;

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->create();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data failed to store: ' . $th->getMessage());
      $this->error('Data failed to store');
    }
  }

  public function show()
  {
    $this->permission($this->basePageName . '-show');

    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {
    $this->permission($this->basePageName . '-update');

    $this->pages = Page::with([
      'permissions' => function ($q) {
        $q->join('actions', 'permissions.action_id', 'actions.id');
        $q->select([
          'permissions.id',
          'permissions.page_id',
          'permissions.action_id',
        ]);
        $q->orderBy('actions.ordinal');
      }
    ])
      ->get();


    $this->position = Position::findOrFail($this->id);

    $this->masterForm->permissions = $this->masterPermissionModel::where('position_id', $this->id)
      ->pluck('permission_id')
      ->toArray();
  }

  public function refreshData()
  {
    $this->isLoading = true;
    $this->edit();
    $this->isLoading = false;
  }


  // public function update()
  // {

  //   $this->permission($this->basePageName.'-update');
  //   $validatedForm = $this->validate(
  //     $this->masterForm->rules(),
  //     [],
  //     $this->masterForm->attributes()
  //   )['masterForm'];



  //   \Illuminate\Support\Facades\DB::beginTransaction();
  //   try {

  //     $validatedForm['position_id'] = $this->id;
  //     $validatedForm['permission_id'] = $validatedForm['permissions'];

  //     $this->masterPermissionModel::where('position_id', $this->id)->delete();

  //     $permissions = [];
  //     foreach ($validatedForm['permissions'] as $permissionId) {
  //       $permissions[] =  [  
  //         'id' => (string) $validatedForm['position_id'].'-'.$permissionId,
  //         'position_id' => $validatedForm['position_id'],
  //         'permission_id' => $permissionId,
  //       ];   
  //     }

  //     $this->masterPermissionModel::insert($permissions);

  //     \Illuminate\Support\Facades\DB::commit();

  //     $this->success('Data has been updated');
  //   } catch (\Throwable $th) {
  //     \Illuminate\Support\Facades\DB::rollBack();
  //     \Log::error('Data failed to update: ' . $th->getMessage());
  //     $this->error('Data failed to update');
  //   }
  // }

  public function update()
  {
    $this->permission($this->basePageName . '-update');

    // Validate the form data  
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
      // Set the position_id  
      $validatedForm['position_id'] = $this->id;

      // Check if all permissions exist  
      foreach ($validatedForm['permissions'] as $permissionId) {
        if (!\Illuminate\Support\Facades\DB::table('permissions')->where('id', $permissionId)->exists()) {
          throw new \Exception("Permission ID {$permissionId} does not exist.");
        }
      }

      // Delete existing position permissions  
      $this->masterPermissionModel::where('position_id', $this->id)->delete();

      // Prepare new permissions for insertion  
      $permissions = [];
      foreach ($validatedForm['permissions'] as $permissionId) {
        $permissions[] = [
          'id' => (string) $validatedForm['position_id'] . '-' . $permissionId,
          'position_id' => $validatedForm['position_id'],
          'permission_id' => $permissionId,
        ];
      }

      // Insert new permissions  
      $this->masterPermissionModel::insert($permissions);

      \Illuminate\Support\Facades\DB::commit();
      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data failed to update: ' . $th->getMessage());
      $this->error('Data failed to update: ' . $th->getMessage());
    }
  }



  public function delete()
  {
    $this->permission($this->basePageName . '-delete');

    $masterData = $this->masterModel::findOrFail($this->id);

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
}
