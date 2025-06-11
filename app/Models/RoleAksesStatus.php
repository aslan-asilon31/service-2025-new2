<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class RoleAksesStatus extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';


    public $table = 'role_akses_status';
    protected $guarded = [];
    protected $keyType = 'string';
    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'tgl_dibuat' => 'datetime: Y-m-d H:i:s',
            'tgl_diupdate' => 'datetime: Y-m-d H:i:s',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
