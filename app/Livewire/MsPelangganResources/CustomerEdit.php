<?php

namespace App\Livewire\CustomerResources;

use App\Livewire\CustomerResources\Forms\CustomerForm;
use Livewire\Component;
use App\Models\Page;
use App\Models\Customer;
use \Livewire\WithFileUploads;
use \Mary\Traits\Toast;
use Livewire\WithPagination;

class CustomerEdit extends Component
{

  use Toast;

  public function render()
  {
    return view('livewire.customer-resources.customer-edit')
      ->title($this->title);
  }

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'customer';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Customer ';

  #[\Livewire\Attributes\Locked]
  public string $url = '/customers';


  #[\Livewire\Attributes\Locked]
  public string $id = '';


  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\Customer::class;

  public CustomerForm $masterForm;

  public function mount()
  {
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
      $validatedForm['updated_by'] = 'admin';
      $masterData->update($validatedForm);
      $this->redirect('/customers', true);
      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      $this->error('Data failed to update');
    }
  }
}
