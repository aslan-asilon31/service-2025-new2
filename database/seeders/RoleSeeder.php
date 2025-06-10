<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();


        $pegawaiList = [
            // ['name' => 'developer', 'guard_name' => 'pegawai'],
            // ['name' => 'supervisor', 'guard_name' => 'pegawai'],
            // ['name' => 'head-office', 'guard_name' => 'pegawai'],
            // ['name' => 'owner', 'guard_name' => 'pegawai'],
            ['name' => 'manager', 'guard_name' => 'pegawai'],
        ];

        foreach ($pegawaiList as $index => $data) {
            $pegawai = new Role();
            $pegawai->name = $data['name'];
            $pegawai->guard_name = $data['guard_name'];
            $pegawai->created_at = $now;
            $pegawai->updated_at = $now;
            $pegawai->save();
        }
    }
}
