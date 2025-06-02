<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Membuat Permissions
        $viewBarang = Permission::create(['name' => 'barang-list']);
        $createBarang = Permission::create(['name' => 'barang-buat']);
        $editBarang = Permission::create(['name' => 'barang-ubah']);
        $deleteBarang = Permission::create(['name' => 'barang-hapus']);

        // Membuat Roles
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            $viewBarang,
            $createBarang,
            $editBarang,
            $deleteBarang
        ]);

        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo([
            $viewBarang,
            $createBarang,
            $editBarang
        ]);

        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo([
            $viewBarang
        ]);
    }
}
