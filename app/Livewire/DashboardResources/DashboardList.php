<?php

namespace App\Livewire\DashboardResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\MsCabang;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Livewire\ProductResources\Forms\ProductForm;
use Mary\Traits\Toast;

class DashboardList extends Component
{

  public string $title = "Dashboard";
  public string $url = "/barang";


  public function mount() {}


  public function render()
  {
    return view('livewire.dashboard-resources.dashboard-list')
      ->title($this->title);
  }
}
