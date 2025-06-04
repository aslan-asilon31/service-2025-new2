<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RoleAksesStatusSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $AllRoleIds = \App\Models\Role::all()->pluck('id')->toArray();
        $AllMsCabangIds = \App\Models\MsCabang::all()->pluck('id')->toArray();

        $getRandomRoleHeaderId = function () use ($AllRoleIds) {
            return $AllRoleIds[array_rand($AllRoleIds)];
        };

        $getRandomMsCabangHeaderId = function () use ($AllMsCabangIds) {
            return $AllMsCabangIds[array_rand($AllMsCabangIds)];
        };

        DB::table('role_akses_status')->insert([
            [
                'id' => Str::uuid(),
                'role_id' => $getRandomRoleHeaderId(),
                'ms_cabang_id' => $getRandomMsCabangHeaderId(),
                'nomor' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
        ]);
    }
}
