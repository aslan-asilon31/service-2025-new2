<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MsCabangSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('ms_cabang')->insert([
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang DKI Jakarta',
                'nomor' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Jawa Barat',
                'nomor' => 2,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Jawa Timur',
                'nomor' => 3,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Sumatera Utara',
                'nomor' => 4,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Bali',
                'nomor' => 5,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Banten',
                'nomor' => 6,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Sulawesi Selatan',
                'nomor' => 7,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Kalimantan Timur',
                'nomor' => 8,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Yogyakarta',
                'nomor' => 9,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Cabang Riau',
                'nomor' => 10,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
        ]);
    }
}
