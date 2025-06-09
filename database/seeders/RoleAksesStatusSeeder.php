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
        $AllMsPegawaiIds = \App\Models\MsPegawai::all()->pluck('id')->toArray();
        $AllMsStatusIds = \App\Models\MsStatus::all()->pluck('id')->toArray();

        $getRandomMsPegawaiHeaderId = function () use ($AllMsPegawaiIds) {
            return $AllMsPegawaiIds[array_rand($AllMsPegawaiIds)];
        };

        $getRandomMsStatusHeaderId = function () use ($AllMsStatusIds) {
            return $AllMsStatusIds[array_rand($AllMsStatusIds)];
        };

        DB::table('pegawai_akses_cabang')->insert([
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomMsCabangHeaderId(),
                'ms_pegawai_id' => $getRandomMsPegawaiHeaderId(),
                'nomor' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomMsCabangHeaderId(),
                'ms_pegawai_id' => $getRandomMsPegawaiHeaderId(),
                'nomor' => 2,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomMsCabangHeaderId(),
                'ms_pegawai_id' => $getRandomMsPegawaiHeaderId(),
                'nomor' => 3,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomMsCabangHeaderId(),
                'ms_pegawai_id' => $getRandomMsPegawaiHeaderId(),
                'nomor' => 4,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomMsCabangHeaderId(),
                'ms_pegawai_id' => $getRandomMsPegawaiHeaderId(),
                'nomor' => 5,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
        ]);
    }
}
