<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;  // Add this for hashing

class MsPegawaiSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $namaKaryawan = [
            'Andi Saputra',
            'Budi Santoso',
            'Citra Dewi',
            'Dewi Lestari',
            'Eko Prasetyo',
            'Fajar Nugroho',
            'Galih Rahman',
            'Hendra Wijaya',
            'Indah Permata',
            'Joko Susilo',
            'Kirana Putri',
            'Lia Amalia',
            'Maya Sari',
            'Niko Hartono',
            'Oki Kurniawan',
            'Putri Anggraini',
            'Qori Pratama',
            'Rizki Maulana',
            'Sari Melati',
            'Teguh Wibowo'
        ];

        $pegawaiData = [];

        foreach ($namaKaryawan as $index => $nama) {

            $email = Str::slug($nama) . '@example.com';

            $pegawaiData[] = [
                'id' => Str::uuid(),
                'nama' => $nama,
                'email' => $email,
                'password' => Hash::make('123123123'),
                'nomor' => $index + 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ];
        }

        DB::table('ms_pegawai')->insert($pegawaiData);
    }
}
