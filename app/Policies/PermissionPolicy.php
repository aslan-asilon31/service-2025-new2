<?php

namespace App\Policies;

use App\Models\MsPegawai;
use App\Models\PegawaiAksesCabang;
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
            abort(403, 'Hak Akses Anda Dibatasi .');
        }

        $aksesCabangId = PegawaiAksesCabang::where('ms_pegawai_id', $pegawai->id)->value('ms_cabang_id');
        if ($aksesCabangId != $cabang) {
            abort(403, 'Hak Akses Anda Dibatasi.');
        }

        if (
            $halaman == 'tanda_terima_service-update' &&
            in_array('admin', $pegawai->getRoleNames()->toArray()) || in_array('staff', $pegawai->getRoleNames()->toArray())
        ) {
            if ($status == 'selesai' || $status == 'draf') {
                abort(403, 'Hak Akses Anda Dibatasi.');
            }
        }

        return true;
    }
}
