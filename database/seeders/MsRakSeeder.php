<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MsRakSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Ambil semua id gudang dari ms_gudang
        $gudangIds = DB::table('ms_gudang')->pluck('id')->toArray();

        $rakData = [];

        for ($i = 1; $i <= 20; $i++) {
            $rakData[] = [
                'id' => Str::uuid(),
                'ms_gudang_id' => $gudangIds[array_rand($gudangIds)], // ambil random gudang id
                'nama' => 'Rak ' . $i,
                'nomor' => $i,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ];
        }

        DB::table('ms_rak')->insert($rakData);
    }
}
