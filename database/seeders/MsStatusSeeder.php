<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\MsPegawai;
use Illuminate\Support\Facades\Hash;

class MsStatusSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $namaStatusList = [
            'Batal',
            'Draf',
            'Selesai',
            'Terbit',
            'Arsip'
        ];

        $data = [];

        foreach ($namaStatusList as $index => $nama) {
            $data[] = [
                'id' => Str::uuid(),
                'nama' => $nama,
                'nomor' => $index + 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ];
        }

        DB::table('ms_status')->insert($data);
    }
}
