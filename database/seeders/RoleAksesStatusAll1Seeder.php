<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\MsStatus;
use Spatie\Permission\Models\Permission;
use App\Models\RoleAksesStatus;
use Spatie\Permission\Models\Role;

class RoleAksesStatusAll1Seeder extends Seeder
{
    public function run()
    {
        // Ambil role admin secara langsung, bukan dari pegawai yang sedang login
        $adminRole = Role::where('name', 'admin')->first(); // Ambil role 'admin'

        if ($adminRole) {
            // Ambil semua permission yang ada
            $permissions = Permission::all();

            // Ambil semua status
            $msStatuses = MsStatus::all();

            // Loop untuk setiap permission
            foreach ($permissions as $permission) {
                // Loop untuk setiap ms_status
                foreach ($msStatuses as $msStatus) {
                    // Cek apakah kombinasi role_id, ms_status_id, permission_id sudah ada
                    $existingEntry = RoleAksesStatus::where('role_id', $adminRole->id)
                        ->where('ms_status_id', $msStatus->id)
                        ->where('permission_id', $permission->id)
                        ->first();

                    if (!$existingEntry) {
                        // Jika tidak ada, buat entry baru
                        RoleAksesStatus::create([
                            'id' => Str::uuid(), // UUID baru untuk setiap entri
                            'role_id' => $adminRole->id, // Gunakan role 'admin'
                            'ms_status_id' => $msStatus->id,
                            'permission_id' => $permission->id,
                            'nomor' => $msStatus->nomor, // Sesuaikan dengan nomor status
                            'dibuat_oleh' => 'system', // Bisa disesuaikan
                            'diupdate_oleh' => 'system', // Bisa disesuaikan
                            'tgl_dibuat' => now(),
                            'tgl_diupdate' => now(),
                            'status' => 'aktif' // Status default
                        ]);

                        // Log untuk mencatat pembuatan entry
                        logger("✅ RoleAksesStatus dibuat: Role ID = {$adminRole->id}, Status ID = {$msStatus->id}, Permission ID = {$permission->id}");
                    }
                }
            }
        } else {
            logger('Role admin tidak ditemukan!');
        }
    }
}
