<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MsPegawai;
use Spatie\Permission\Models\Role;

class ModelHasRoleSeeder extends Seeder
{
    public function run()
    {
        $pegawaiList = MsPegawai::all();
        $roles = Role::all();

        if ($pegawaiList->isEmpty() || $roles->isEmpty()) {
            $this->command->warn('❌ Tidak ada data pegawai atau role ditemukan.');
            return;
        }

        // Ambil satu role secara acak untuk setiap pegawai
        $data = $pegawaiList->map(function ($pegawai) use ($roles) {
            $role = $roles->random();

            return [
                'role_id'    => $role->id,
                'model_type' => MsPegawai::class,
                'model_id'   => $pegawai->id,
            ];
        })->toArray();

        DB::table('model_has_roles')->insert($data);

        $this->command->info('✅ Berhasil assign role ke semua MsPegawai (tanpa loop manual).');
    }
}
