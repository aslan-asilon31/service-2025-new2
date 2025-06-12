<?php

namespace App\Livewire\TandaTerimaServiceHeaderResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class TandaTerimaServiceDetailForm extends Form
{
  public string|null $id = null;
  public string|null $ms_barang_id = null;
  public string|null $ms_rak_id = null;
  public string|null $catatan = null;
  public int|null $qty = null;
  public int|null $nomor = null;
  public string|null $tgl_dibuat = null;
  public string|null $dibuat_oleh = null;
  public string|null $diupdate_oleh = null;

  public function rules(string|null $id = null): array
  {
    return [
      'detailForm.id' => 'required|string',
      'detailForm.ms_barang_id' => 'required|string',
      'detailForm.ms_rak_id' => 'required|string',
      'detailForm.catatan' => 'required|string',
      'detailForm.qty' => 'nullable|integer',
      'detailForm.nomor' => 'nullable|integer',
      'detailForm.tgl_dibuat' => 'required|string',
      'detailForm.dibuat_oleh' => 'required|string',
      'detailForm.diupdate_oleh' => 'required|string',
    ];
  }

  public function attributes(): array
  {
    return [
      'detailForm.id' => 'ID',
      'detailForm.ms_barang_id' => 'Master Barang ID',
      'detailForm.ms_rak_id' => 'Master Rak ID',
      'detailForm.catatan' => 'Catatan',
      'detailForm.qty' => 'Quantity',
      'detailForm.nomor' => 'Nomor',
      'detailForm.tgl_dibuat' => 'Tanggal Dibuat',
      'detailForm.dibuat_oleh' => 'Dibuat oleh',
      'detailForm.diupdate_oleh' => 'Diupdate oleh',
    ];
  }
}
