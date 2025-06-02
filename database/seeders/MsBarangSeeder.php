<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MsBarangSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $lastNomor = DB::table('ms_barang')->max('nomor') ?? 0;

        $barangNames = [
            'Humidifier',
            'Dehumidifier',
            'Dishwasher',
            'Electric Kettle',
            'Hand Mixer',
            'Bread Maker',
            'Hair Dryer',
            'Electric Shaver',
            'Steam Iron',
            'Robotic Vacuum',
            'Smart Light',
            'Smart Plug',
            'Air Fryer',
            'Meat Grinder',
            'Induction Stove',
            'Slow Cooker',
            'Pressure Cooker',
            'Portable Heater',
            'Electric Blanket',
            'Ceiling Fan',
        ];

        $insertData = [];

        foreach ($barangNames as $index => $nama) {
            $insertData[] = [
                'id' => Str::uuid(),
                'sync_id' => null,
                'nama' => $nama,
                'nomor' => $lastNomor + $index + 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ];
        }

        DB::table('ms_barang')->insert($insertData);
    }
}
