<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class RoleHasPermission extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public $table = 'role_has_permissions';

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'id');
    }
}
