<?php

namespace App\Helpers\Permission\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\MsPegawai;
use Illuminate\Support\Facades\DB;

trait WithPermission
{
    public function permission(string $permissionId)
    {

        $user = Auth::guard('pegawai')->user();

        if (!$user) {
            return $this->unauthorizedPermission('Anda tidak diizinkan untuk masuk.');
        }

        // $permissionNames = $user->getAllPermissions()->pluck('nama')->toArray();

        $permissionNames = DB::table('model_has_roles')
            ->join('role_has_permissions', 'model_has_roles.role_id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->where('model_has_roles.model_id', $user->id)
            ->where('model_has_roles.model_type', MsPegawai::class)
            ->pluck('permissions.name')
            ->toArray();


        if (empty($permissionNames)) {
            return $this->unauthorizedPermission('Anda tidak diizinkan untuk masuk.');
        }

        if (!in_array($permissionId, $permissionNames)) {
            abort(403, 'Anda tidak diizinkan untuk masuk ke halaman ini');
        }

        return true;
    }
}
