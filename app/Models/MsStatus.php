<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsStatus extends Model
{
    use HasFactory, HasUuids;

    public function newUniqueId(): string
    {
        return (string) str()->orderedUuid();
    }
    protected $guarded = [];
    protected $keyType = 'string';
    protected $table = 'ms_status';
    public $incrementing = false;

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
