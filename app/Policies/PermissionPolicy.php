<?php

namespace App\Policies;

use App\Models\MsPegawai;
use App\Models\MsStatus;
use Spatie\Permission\Models\Permission;
use App\Models\PegawaiAksesCabang;
use App\Models\RoleAksesStatus;
use App\Models\TrTandaTerimaServiceHeader;

class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {
        $pegawai = \Illuminate\Support\Facades\Auth::guard('pegawai')->user();

        $hasPermission = $pegawai->getAllPermissions()
            ->pluck('name')
            ->contains($halaman);
        if (!$hasPermission) {
            abort(403, 'Hak Akses Anda Dibatasi1.');
        }

        $aksesCabangId = PegawaiAksesCabang::where('ms_pegawai_id', $pegawai->id)->value('ms_cabang_id');
        if ($aksesCabangId != $cabang) {
            abort(403, 'Hak Akses Anda Dibatasi2.');
        }

        // $roleId = $pegawai->roles()->whereIn('name', $pegawai->getRoleNames())->pluck('id')->toArray();
        // $halamanId = Permission::where('name', $halaman)->pluck('id')->toArray();
        // $statusId = MsStatus::where('nama', $status)->pluck('id')->toArray();


        $statusId = MsStatus::where('nama', 'terbit')->value('id');
        $halamanId = Permission::where('name', $halaman)->value('id');
        $roleId = $pegawai->roles()->pluck('id')->toArray();
        $hasAksesStatus = RoleAksesStatus::where('role_id', $roleId)
            ->where('ms_status_id', $statusId)
            ->where('permission_id', $halamanId)
            ->where('status', 'aktif')
            ->exists();

        if (!$hasAksesStatus) {
            abort(403, 'Role Anda tidak memiliki izin untuk mengubah ke status ini.');
        }

        if ($status == 'terbit' && !in_array($pegawai->getRoleNames()->first(), ['manager', 'head-office', 'developer'])) {
            RoleAksesStatus::whereIn('role_id', $roleId)
                ->where('permission_id', $halamanId)
                ->where('status', 'aktif')
                ->where('ms_status_id', '!=', $statusId)
                ->update(['status' => 'tidak-aktif']);
        }

        return true;
    }
}
