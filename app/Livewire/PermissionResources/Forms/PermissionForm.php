<?php

namespace App\Livewire\PermissionResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class PermissionForm extends Form
{
  public ?string $id;
  public array $permissions = [];
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.id' => ['nullable', 'string', 'max:255'],
      'masterForm.permissions' => ['required', 'array'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.id' => 'Id',
      'masterForm.permissions' => 'Permissions',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
