<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class MsPegawai  extends  Authenticatable
{
    use HasFactory, HasUuids,  HasRoles;

    public function newUniqueId(): string
    {
        return (string) str()->orderedUuid();
    }

    protected $fillable = ['nama', 'email', 'password'];

    protected $hidden = ['password'];

    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'ms_pegawai';
    public $timestamps = false;

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

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifierName()
    {
        return $this->email;
    }
}
