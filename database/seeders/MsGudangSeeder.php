<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MsGudangSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $cabangIds = DB::table('ms_cabang')->pluck('id');

        foreach ($cabangIds as $cabangId) {
            $jumlahGudang = rand(2, 3);

            for ($i = 1; $i <= $jumlahGudang; $i++) {
                DB::table('ms_gudang')->insert([
                    'id' => Str::uuid(),
                    'ms_cabang_id' => $cabangId,
                    'nama' => 'Gudang ' . chr(64 + $i),
                    'nomor' => $i,
                    'dibuat_oleh' => 'admin',
                    'diupdate_oleh' => 'admin',
                    'tgl_dibuat' => $now,
                    'tgl_diupdate' => $now,
                    'status' => 'aktif',
                ]);
            }
        }
    }
}
