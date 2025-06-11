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

        DB::table('pegawai_akses_cabang')->insert([
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => '1546b884-d31b-4596-959f-a18088ca105e',
                'ms_pegawai_id' => '01975916-74ca-7311-92b0-6202a26bf1bd',
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
