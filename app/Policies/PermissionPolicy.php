<?php

namespace App\Policies;

use App\Models\MsPegawai;

class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(MsPegawai $pegawai,  $halaman, $cabang, $status)
    {
        dd('stop23');
        //user->role, 
        //halaman, cabang, status

        return $pegawai->hasAnyPermission($halaman) && $cabang === $pegawai->cabang_kode;
    }
}
