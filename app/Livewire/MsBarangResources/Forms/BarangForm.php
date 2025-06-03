<?php

namespace App\Livewire\MsBarangResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class BarangForm extends Form
{
  public string|null $nama = null;
  public int|null $nomor = null;



  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.nama' => 'required|string',
      'masterForm.nomor' => 'nullable|integer',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.nama' => 'Nama',
      'masterForm.nomor' => 'Nomor',
    ];
  }
}
