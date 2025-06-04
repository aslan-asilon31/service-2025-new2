<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PegawaiAksesCabangSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $AllMsCabangIds = \App\Models\MsCabang::all()->pluck('id')->toArray();
        $AllMsPegawaiIds = \App\Models\MsPegawai::all()->pluck('id')->toArray();

        $getRandomMsCabangHeaderId = function () use ($AllMsCabangIds) {
            return $AllMsCabangIds[array_rand($AllMsCabangIds)];
        };

        $getRandomMsPegawaiHeaderId = function () use ($AllMsPegawaiIds) {
            return $AllMsPegawaiIds[array_rand($AllMsPegawaiIds)];
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
