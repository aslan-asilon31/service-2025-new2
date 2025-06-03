<?php

namespace App\Livewire\DashboardResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\MsPegawai;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Livewire\ProductResources\Forms\ProductForm;
use Mary\Traits\Toast;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class DashboardList extends Component
{

  public string $title = "Dashboard";
  public string $url = "/barang";
  public $user_role;


  public function mount()
  {
    $user = Auth::guard('pegawai')->user();


    $pegawai = MsPegawai::with('modelHasRoles.role')->find($user->id);

    foreach ($pegawai->modelHasRoles as $pivot) {
      $this->user_role =  $pivot->role->name;
    }
  }


  public function render()
  {
    return view('livewire.dashboard-resources.dashboard-list')
      ->title($this->title);
  }
}
