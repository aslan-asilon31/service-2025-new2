<?php

namespace App\Livewire\MsCabangResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class CabangForm extends Form
{
  public string|null $nama = null;
  public int|null $nomor = null;
  public string|null $dibuat_oleh = null;
  public string|null $diupdate_oleh = null;



  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.nama' => 'required|string',
      'masterForm.nomor' => 'nullable|integer',
      'masterForm.dibuat_oleh' => 'required|string',
      'masterForm.diupdate_oleh' => 'required|string',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.nama' => 'Nama',
      'masterForm.nomor' => 'Nomor',
      'masterForm.dibuat_oleh' => 'Dibuat Oleh',
      'masterForm.diupdate_oleh' => 'Diupdate Oleh',
    ];
  }
}
