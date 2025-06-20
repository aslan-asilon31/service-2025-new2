<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ModelHasRole extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public $table = 'model_has_roles';
    protected $fillable = ['role_id', 'model_type', 'model_id'];
    const CREATED_AT = 'tgl_dibuat';
    const UPDATED_AT = 'tgl_diupdate';


    protected $casts = [
        'model_id' => 'string',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
