<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\MsPegawai;
use App\Models\Permission;
use App\Models\MsStatus;

class RoleAksesStatusSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $roleIds = Role::pluck('id')->toArray();
        $statusIds  = MsStatus::pluck('id')->toArray();
        $permissionIds  = permission::pluck('id')->toArray();

        $randomRoleId = fn() => $roleIds[array_rand($roleIds)];
        $randomStatusId  = fn() => $statusIds[array_rand($statusIds)];
        $randomPermissionId  = fn() => $permissionIds[array_rand($permissionIds)];

        $data = [];

        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'id'             => Str::uuid(),
                'role_id'  => $randomRoleId(),
                'ms_status_id'   => $randomStatusId(),
                'permission_id'  => $randomPermissionId(),
                'nomor'          => $i,
                'dibuat_oleh'    => 'admin',
                'diupdate_oleh'  => 'admin',
                'tgl_dibuat'     => $now,
                'tgl_diupdate'   => $now,
                'status'         => 'aktif',
            ];
        }

        // Masukkan ke tabel
        DB::table('role_akses_status')->insert($data);
    }
}
