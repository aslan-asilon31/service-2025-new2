<?php

namespace App\Policies;

use App\Models\TandaTerimaServiceHeader;
use App\Models\MsPegawai;
use App\Models\RoleAksesStatus;
use App\Models\TrTandaTerimaServiceHeader;
use Illuminate\Support\Facades\Gate;

class RoleAksesStatusPolicy
{

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
