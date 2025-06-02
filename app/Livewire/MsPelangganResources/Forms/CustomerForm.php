<?php

namespace App\Livewire\CustomerResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class CustomerForm extends Form
{
  public ?string $id;
  public ?string $first_name;
  public ?string $last_name;
  public ?string $phone;
  public ?string $email;
  public ?string $created_by;
  public ?string $updated_by;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.id' => ['nullable', 'string', 'max:255'],
      'masterForm.first_name' => ['required', 'string', 'max:255'],
      'masterForm.last_name' => ['required', 'string', 'max:255'],
      'masterForm.phone' => ['required', 'string', 'max:255'],
      'masterForm.email' => ['required', 'string', 'max:255'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.id' => 'Id',
      'masterForm.name' => 'Name',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
