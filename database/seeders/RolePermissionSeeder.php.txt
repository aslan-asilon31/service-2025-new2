<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $roles = ['developer', 'manager', 'staff'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $permissionName = 'view sp-tanda-terima-service';

        $permission = Permission::firstOrCreate(['name' => $permissionName]);

        Role::whereIn('name', ['developer', 'manager', 'staff'])->each(function ($role) use ($permission) {
            $role->givePermissionTo($permission);
        });
    }
}
