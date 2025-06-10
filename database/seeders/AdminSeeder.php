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

        // Data pegawai yang akan dimasukkan
        $pegawaiList = [
            ['nama' => 'Admin', 'email' => 'admin@gmail.com'],
            ['nama' => 'Manager', 'email' => 'manager@gmail.com'],
            ['nama' => 'Staff', 'email' => 'staff@gmail.com'],
        ];

        foreach ($pegawaiList as $index => $data) {
            $pegawai = new MsPegawai();
            $pegawai->nama = $data['nama'];
            $pegawai->email = $data['email'];
            $pegawai->password = Hash::make('password');
            $pegawai->nomor = $lastNumber + $index + 1;
            $pegawai->tgl_dibuat = $now;
            $pegawai->tgl_diupdate = $now;
            $pegawai->status = 'aktif';
            $pegawai->save();
        }
    }
}
