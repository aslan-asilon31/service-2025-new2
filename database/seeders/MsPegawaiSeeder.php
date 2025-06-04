<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\MsPegawai;
use Illuminate\Support\Facades\Hash;

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





        // Ambil nomor terakhir
        $lastNumber = MsPegawai::max('nomor') ?? 0;

        // Admin
        $admin = new MsPegawai();
        $admin->nama = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('password');
        $admin->nomor = $lastNumber + 1;
        $admin->tgl_dibuat = $now;
        $admin->tgl_diupdate = $now;
        $admin->status = 'aktif';
        $admin->save();

        // Manager
        $manager = new MsPegawai();
        $manager->nama = 'Manager';
        $manager->email = 'manager@gmail.com';
        $manager->password = Hash::make('password');
        $manager->nomor = $lastNumber + 2;
        $admin->tgl_dibuat = $now;
        $admin->tgl_diupdate = $now;
        $manager->status = 'aktif';
        $manager->save();

        // Staff
        $staff = new MsPegawai();
        $staff->nama = 'Staff';
        $staff->email = 'staff@gmail.com';
        $staff->password = Hash::make('password');
        $staff->nomor = $lastNumber + 3;
        $admin->tgl_dibuat = $now;
        $admin->tgl_diupdate = $now;
        $staff->status = 'aktif';
        $staff->save();
    }
}
