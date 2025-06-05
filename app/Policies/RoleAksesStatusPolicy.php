<?php

namespace App\Policies;

use App\Models\TandaTerimaServiceHeader;
use App\Models\MsPegawai;

class RoleAksesStatusPolicy
{

    public function __construct()
    {
        //
    }

    public function updateStatus(MsPegawai $pegawai, TandaTerimaServiceHeader $header, string $newStatus): bool
    {
        $allowedStatusByRole = [
            'draf'    => ['admin'],
            'selesai' => ['staff', 'manager'],
            'terbit'  => ['manager'],
            'arsip'   => ['admin'],
        ];

        $rolesAllowed = $allowedStatusByRole[$newStatus] ?? [];

        return $pegawai->hasAnyRole($rolesAllowed);
    }
}
