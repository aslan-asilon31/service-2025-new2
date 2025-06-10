<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Helpers\Permission\Traits\HasAccess;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MsPegawai  extends  Authenticatable
{
    use HasFactory, HasUuids,  HasRoles, HasAccess;
    protected $guard_name = 'pegawai';
    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'ms_pegawai';
    public $timestamps = false;
    public $guarded = [];

    public function modelHasRoles()
    {
        return $this->hasMany(ModelHasRole::class, 'model_id');
    }

    public function roles()
    {
        return $this->belongsToMany(
            \Spatie\Permission\Models\Role::class,
            'model_has_roles',
            'model_id',
            'role_id'
        )->where('model_type', self::class);
    }

    public function trTandaTerimaServiceHeader()
    {
        return $this->belongsTo(TrTandaTerimaServiceHeader::class, 'ms_pegawai_id', 'id');
    }


    public function pegawaiAksesCabang(): HasOne
    {
        return $this->hasOne(PegawaiAksesCabang::class);
    }
}
