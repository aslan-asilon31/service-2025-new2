<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsCabang extends Model
{
    use HasFactory, HasUuids;

    public function newUniqueId(): string
    {
        return (string) str()->orderedUuid();
    }
    protected $guarded = [];
    protected $keyType = 'string';
    protected $table = 'ms_cabang';
    public $incrementing = false;

    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';

    protected function casts(): array
    {
        return [
            'tgl_dibuat' => 'datetime: Y-m-d H:i:s',
            'tgl_diupdate' => 'datetime: Y-m-d H:i:s',
        ];
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function msCabangDetails()
    {
        return $this->hasMany(\App\Models\MsCabangDetail::class, 'ms_cabang_id', 'id');
    }

    public function pegawaiAksesCabang()
    {
        return $this->belongsTo(\App\Models\PegawaiAksesCabang::class);
    }


    public function trTandaTerimaServiceHeader()
    {
        return $this->belongsTo(TrTandaTerimaServiceHeader::class, 'ms_cabang_id', 'id');
    }
}
