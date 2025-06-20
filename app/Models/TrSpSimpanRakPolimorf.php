<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class TrSpSimpanRakPolimorf extends Model
{
    use HasFactory, HasUuids, HasRoles;

    public function newUniqueId(): string
    {
        return (string) str()->orderedUuid();
    }

    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
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
}
