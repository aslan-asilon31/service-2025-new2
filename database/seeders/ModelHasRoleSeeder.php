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
                'role_id'    => 2, // developer
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01975931-1812-7163-932d-41e7c92bbbf6',
            ],
            [
                'role_id'    => 5, // owner
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01973477-e351-70ec-a44c-56338a094e07',
            ],
            [
                'role_id'    => 4, // head-office
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01975931-b6e0-72ae-bea0-34e0b46e12f9',
            ],
            [
                'role_id'    => 3, // supervisor
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01975931-b7d8-73a4-ad1d-b83edd9dd889',
            ],
            [
                'role_id'    => 7, // manager
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01975916-74ca-7311-92b0-6202a26bf1bd',
            ],
            [
                'role_id'    => 1, // admin
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01975916-894a-726e-9010-4e4842c2916d',
            ],
            [
                'role_id'    => 2, // Staff
                'model_type' => 'App\Models\MsPegawai',
                'model_id'   => '01975916-75c2-71a5-8561-bd47a3b1d499',
            ],
        ]);
    }
}
