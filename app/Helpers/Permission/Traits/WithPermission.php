<?php

namespace App\Helpers\Permission\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\MsPegawai;
use Illuminate\Support\Facades\DB;

trait WithPermission
{
    public function permission(string $permissionId)
    {
        $pegawai = Auth::guard('pegawai')->user();

        $permissionNames = $pegawai->getAllPermissions()->pluck('name')->toArray();

        if (empty($permissionNames)) {
            return $this->unauthorizedPermission('Anda tidak diizinkan untuk masuk.');
        }

        return true;
    }
}
