<?php

namespace App\Livewire\CustomerResources;

use App\Livewire\CustomerResources\Forms\CustomerForm;
use Livewire\Component;
use App\Models\Page;
use App\Models\Customer;

class CustomerCreate extends Component
{
  public function render()
  {
    return view('livewire.customer-resources.customer-create')
      ->title($this->title);
  }

  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'customer';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Customer';

  #[\Livewire\Attributes\Locked]
  public string $url = '/customers';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'customer_image';

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
  protected $masterModel = \App\Models\Customer::class;

  public CustomerForm $masterForm;

  public function mount() {}

  public function create()
  {

    $this->masterForm->reset();
  }

  public function store()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    try {

      $validatedForm['created_by'] = 'admin';
      $validatedForm['updated_by'] = 'admin';

      $this->masterModel::create($validatedForm);
      $this->redirect('/customers', true);
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Log::error('Data failed to store: ' . $th->getMessage());
      $this->error('Data failed to store');
    }
  }
}
