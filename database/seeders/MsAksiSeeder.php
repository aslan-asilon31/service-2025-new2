<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MsAksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Batal',
            'Draf',
            'Selesai',
            'Terbit',
            'Arsip'
        ];

        $timestamp = Carbon::now();

        foreach ($data as $index => $nama) {
            DB::table('ms_aksi')->insert([
                'id' => Str::uuid(),
                'nama' => $nama,
                'nomor' => $index + 1,
                'dibuat_oleh' => 'seeder',
                'diupdate_oleh' => 'seeder',
                'tgl_dibuat' => $timestamp,
                'tgl_diupdate' => $timestamp,
                'status' => 'aktif',
            ]);
        }
    }
}
