<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TandaTerimaServiceHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allPelangganIds = DB::table('ms_pelanggan')->pluck('id')->toArray();
        $allCabangIds = DB::table('ms_cabang')->pluck('id')->toArray();

        $getRandomPelangganId = function () use ($allPelangganIds) {
            return $allPelangganIds[array_rand($allPelangganIds)];
        };

        $getRandomCabangId = function () use ($allCabangIds) {
            return $allCabangIds[array_rand($allCabangIds)];
        };

        DB::table('tr_tanda_terima_service_header')->insert([
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomCabangId(),
                'ms_pelanggan_id' => $getRandomPelangganId(),
                'nama' => 'Tanda Terima 1',
                'nomor' => 1,
                'memo' => 'Kerusakan 1',
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomCabangId(),
                'ms_pelanggan_id' => $getRandomPelangganId(),
                'nama' => 'Tanda Terima 2',
                'nomor' => 2,
                'memo' => 'Kerusakan 2',
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomCabangId(),
                'ms_pelanggan_id' => $getRandomPelangganId(),
                'nama' => 'Tanda Terima 3',
                'nomor' => 3,
                'memo' => 'Kerusakan 3',
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomCabangId(),
                'ms_pelanggan_id' => $getRandomPelangganId(),
                'nama' => 'Tanda Terima 4',
                'nomor' => 4,
                'memo' => 'Kerusakan 4',
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomCabangId(),
                'ms_pelanggan_id' => $getRandomPelangganId(),
                'nama' => 'Tanda Terima 5',
                'nomor' => 5,
                'memo' => 'Kerusakan 5',
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_cabang_id' => $getRandomCabangId(),
                'ms_pelanggan_id' => $getRandomPelangganId(),
                'nama' => 'Tanda Terima 6',
                'nomor' => 6,
                'memo' => 'Kerusakan 6',
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
        ]);
    }
}
