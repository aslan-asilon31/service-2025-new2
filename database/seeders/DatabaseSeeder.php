<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            MsBarangSeeder::class,
            MsCabangSeeder::class,
            MsPelangganSeeder::class,
            MsGudangSeeder::class,
            MsPegawaiSeeder::class,
            MsRakSeeder::class,
            MsRakKategoriSeeder::class,
            MsAksiSeeder::class,
            RoleAndPermissionSeeder::class,
        ]);
    }
}
