<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('model_has_roles')->insert([
            [
                'role_id'    => 1, // Admin
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01973477-e351-70ec-a44c-56338a094e07',
            ],
            [
                'role_id'    => 2, // Manager
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01973477-e444-733e-b69e-93f967d66844',
            ],
            [
                'role_id'    => 2, // Staff
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01973477-e529-70e0-ab32-0d3f4b10f7f6',
            ],
        ]);
    }
}
