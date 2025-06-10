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

        $permissionNames = $user->getAllPermissions()->pluck('name')->toArray();

        if (empty($permissionNames)) {
            return $this->unauthorizedPermission('Anda tidak diizinkan untuk masuk.');
        }

        return true;
    }
}
