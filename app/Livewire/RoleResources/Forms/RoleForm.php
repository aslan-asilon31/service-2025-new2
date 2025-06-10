<?php

namespace App\Livewire\RoleResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class RoleForm extends Form
{
  public string|null $name = null;
  public string|null $availability = 'in-stock';
  public TemporaryUploadedFile|string|null $image_url;
  public float|null $selling_price = 0;
  public float|null $discount_persentage = 0;
  public float|null $discount_value = 0;
  public float|null $nett_price = 0;
  public float|null $weight = 0;
  public float|null $rating = 0;
  public float|null $sold_qty = 0;
  public int|null $is_activated = null;


  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.name' => 'required|string',
      'masterForm.guard_name' => 'required|string',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.guard_name' => 'Guard Name',
    ];
  }
}
