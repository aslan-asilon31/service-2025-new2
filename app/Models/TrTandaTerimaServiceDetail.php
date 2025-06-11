<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class TrTandaTerimaServiceDetail extends Model
{
    use HasFactory, HasUuids;

    public function newUniqueId(): string
    {
        return (string) str()->orderedUuid();
    }

    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    protected $table = 'tr_tanda_terima_service_detail';

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

    public function trSpTandaTerimaServiceHeader()
    {
        return $this->belongsTo(TrTandaTerimaServiceHeader::class, 'tr_tanda_terima_service_header_id', 'id');
    }
}
