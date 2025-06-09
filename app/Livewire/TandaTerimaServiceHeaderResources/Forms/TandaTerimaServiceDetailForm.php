<?php

namespace App\Livewire\TandaTerimaServiceHeaderResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class TandaTerimaServiceDetailForm extends Form
{
  public string|null $id = null;
  public string|null $catatan = null;
  public int|null $qty = null;
  public int|null $nomor = null;
  public string|null $memo = null;
  public string|null $dibuat_oleh = null;
  public string|null $diupdate_oleh = null;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.id' => 'required|string',
      'masterForm.catatan' => 'required|string',
      'masterForm.qty' => 'nullable|integer',
      'masterForm.nomor' => 'nullable|integer',
      'masterForm.memo' => 'required|string',
      'masterForm.dibuat_oleh' => 'required|string',
      'masterForm.diupdate_oleh' => 'required|string',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.id' => 'ID',
      'masterForm.catatan' => 'Catatan',
      'masterForm.qty' => 'Quantity',
      'masterForm.nomor' => 'Nomor',
      'masterForm.dibuat_oleh' => 'Dibuat Oleh',
      'masterForm.diupdate_oleh' => 'Diupdate Oleh',
    ];
  }
}
