<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use App\Models\MsStatus;
use App\Models\Permission;
use App\Models\RoleAksesStatus;

class RoleAksesStatusAllSeeder extends Seeder
{
    public function run()
    {
        // Ambil data pegawai yang sedang login
        $pegawai = Auth::guard('pegawai')->user();

        // Ambil semua permission yang dimiliki pegawai (dari role yang ada di pegawai)
        $permissionNames = $pegawai->getAllPermissions()->pluck('name')->toArray();

        // Ambil semua status yang ada di MsStatus
        $msStatuses = MsStatus::all();

        // Cek apakah pegawai memiliki role 'admin'
        if ($pegawai->hasRole('admin')) {
            // Ambil role 'admin' secara langsung
            $adminRole = \App\Models\Role::where('name', 'admin')->first();

            // Looping untuk setiap permission yang dimiliki pegawai
            foreach ($permissionNames as $permissionName) {
                // Ambil permission berdasarkan name
                $permission = Permission::where('name', $permissionName)->first();

                // Jika permission ditemukan
                if ($permission && $adminRole) {
                    // Looping untuk setiap status di MsStatus
                    foreach ($msStatuses as $msStatus) {
                        // Cek apakah sudah ada entry untuk kombinasi role_id, ms_status_id, permission_id
                        $existingEntry = RoleAksesStatus::where('role_id', $adminRole->id)
                            ->where('ms_status_id', $msStatus->id)
                            ->where('permission_id', $permission->id)
                            ->first();

                        // Jika tidak ada entry, buat entry baru
                        if (!$existingEntry) {
                            RoleAksesStatus::create([
                                'id' => \Str::uuid(), // UUID baru untuk setiap entri
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

                            // Log untuk mengetahui entri baru dibuat
                            logger("✅ RoleAksesStatus dibuat: Role ID = {$adminRole->id}, Status ID = {$msStatus->id}, Permission ID = {$permission->id}");
                        }
                    }
                }
            }
        }
    }
}
