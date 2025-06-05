<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            // AdminSeeder::class,
            // MsBarangSeeder::class,
            // MsPegawaiSeeder::class,
            // MsPelangganSeeder::class,
            // MsCabangSeeder::class,
            // MsCabangDetailSeeder::class,
            // MsGudangSeeder::class,
            // MsRakSeeder::class,
            // MsRakKategoriSeeder::class,
            // MsAksiSeeder::class,
            // RoleAndPermissionSeeder::class,
            // TandaTerimaServiceHeaderSeeder::class,
            // TandaTerimaServiceDetailSeeder::class,
            // MsCabangDetailSeeder::class,
            // PegawaiAksesCabangSeeder::class,
            // RoleAksesStatusSeeder::class,
            // MsAksiSeeder::class,
            ModelHasRoleSeeder::class,
        ]);
    }
}
