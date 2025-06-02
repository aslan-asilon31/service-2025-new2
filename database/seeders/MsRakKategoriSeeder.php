<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MsRakKategoriSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Ambil semua id rak dari ms_rak
        $rakIds = DB::table('ms_rak')->pluck('id')->toArray();

        $kategoriData = [];

        for ($i = 1; $i <= 20; $i++) {
            $kategoriData[] = [
                'id' => Str::uuid(),
                'ms_rak_id' => $rakIds[array_rand($rakIds)], // ambil random rak id
                'nama' => 'Kategori ' . $i,
                'nomor' => $i,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ];
        }

        DB::table('ms_rak_kategori')->insert($kategoriData);
    }
}
