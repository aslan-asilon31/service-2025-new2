<?php

namespace App\Livewire\TandaTerimaServiceHeaderResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class TandaTerimaServiceHeaderForm extends Form
{
  public string|null $nama = null;
  public string|null $ms_pelanggan_id = null;
  public string|null $ms_cabang_id = null;
  public int|null $nomor = null;
  public string|null $memo = null;
  public string|null $dibuat_oleh = null;
  public string|null $diupdate_oleh = null;
  public string|null $status = "";

  public function rules(string|null $id = null): array
  {
    return [
      'headerForm.nama' => 'required|string',
      'headerForm.ms_pelanggan_id' => 'required|string',
      'headerForm.ms_cabang_id' => 'required|string',
      'headerForm.nomor' => 'nullable|integer',
      'headerForm.memo' => 'required|string',
      'headerForm.dibuat_oleh' => 'required|string',
      'headerForm.diupdate_oleh' => 'required|string',
      'headerForm.status' => 'required|string',
    ];
  }

  public function attributes(): array
  {
    return [
      'headerForm.nama' => 'Nama',
      'headerForm.ms_pelanggan_id' => 'Pelanggan ID',
      'headerForm.ms_cabang_id' => 'Cabang ID',
      'headerForm.nomor' => 'Nomor',
      'headerForm.dibuat_oleh' => 'Dibuat Oleh',
      'headerForm.diupdate_oleh' => 'Diupdate Oleh',
      'headerForm.status' => 'Status',
    ];
  }
}
