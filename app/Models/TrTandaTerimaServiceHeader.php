<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class TrTandaTerimaServiceHeader extends Model
{
    use HasFactory, HasUuids, HasRoles;

    public function newUniqueId(): string
    {
        return (string) str()->orderedUuid();
    }

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    protected $table = 'tr_tanda_terima_service_header';

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



    public function msCabangs()
    {
        return $this->hasMany(MsCabang::class);
    }

    public function msPelanggan()
    {
        return $this->hasOne(MsPelanggan::class, 'id', 'ms_pelanggan_id');
    }

    public function msCabang()
    {
        return $this->hasOne(MsCabang::class, 'id', 'ms_cabang_id');
    }

    public function trTandaTerimaSuratPerintahServiceDetail()
    {
        return $this->hasMany(TrTandaTerimaServiceDetail::class, 'id', 'tr_tanda_terima_service_header_id');
    }
}
