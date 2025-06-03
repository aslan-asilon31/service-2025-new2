<?php

namespace App\Policies;

use App\Models\MsPegawai;

class RoleAksesStatusPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function accessHalaman(MsPegawai $msPegawai)
    {
        dd($msPegawai->roles());
        return $msPegawai->roles()->name === 'Gold';
    }
}
