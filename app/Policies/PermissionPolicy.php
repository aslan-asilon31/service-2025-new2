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

    public function simpan(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {

        $adakahPermission = $msPegawai->getAllPermissions()
            ->pluck('name')
            ->contains($halaman);
        if (!$adakahPermission) {
            return false;
        }

        $adakahAksesCabang = PegawaiAksesCabang::where('ms_pegawai_id', $msPegawai->id)->value('ms_cabang_id');
        if ($adakahAksesCabang != $cabang) {
            return false;
        }

        $halamanId = Permission::where('name', $halaman)->value('id');
        $adakahAksesStatus = RoleAksesStatus::where('role_id', $msPegawai->roles()->pluck('id')->toArray())
            ->where('permission_id', $halamanId)
            ->where('status', 'aktif')
            ->exists();
        if ($adakahAksesStatus != $status) {
            return false;
        }

        if ($adakahPermission && $adakahAksesCabang && $adakahAksesStatus)
            $diizinkankahsemua = true;
        else {
            $diizinkankahsemua = false;
        }
        return $diizinkankahsemua;
    }

    public function update(MsPegawai $msPegawai, $halaman, $cabang, $status): bool
    {

        $adakahPermission = $msPegawai->getAllPermissions()
            ->pluck('name')
            ->contains($halaman);
        if (!$adakahPermission) {
            return false;
        }

        $adakahAksesCabang = PegawaiAksesCabang::where('ms_pegawai_id', $msPegawai->id)->value('ms_cabang_id');
        if ($adakahAksesCabang != $cabang) {
            return false;
        }

        $halamanId = Permission::where('name', $halaman)->value('id');
        $adakahAksesStatus = RoleAksesStatus::where('role_id', $msPegawai->roles()->pluck('id')->toArray())
            ->where('permission_id', $halamanId)
            ->where('status', 'aktif')
            ->exists();
        if ($adakahAksesStatus != $status) {
            return false;
        }

        if ($adakahPermission && $adakahAksesCabang && $adakahAksesStatus)
            $diizinkankahsemua = true;
        else {
            $diizinkankahsemua = false;
        }
        return $diizinkankahsemua;
    }
}
