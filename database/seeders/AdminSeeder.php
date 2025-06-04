<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MsPegawai;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();


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
