<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\MsPegawai;
use App\Models\MsStatus;

class RoleAksesStatusSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Ambil semua ID pegawai dan status
        $pegawaiIds = MsPegawai::pluck('id')->toArray();
        $statusIds  = MsStatus::pluck('id')->toArray();

        // Helper untuk mengambil ID acak
        $randomPegawaiId = fn() => $pegawaiIds[array_rand($pegawaiIds)];
        $randomStatusId  = fn() => $statusIds[array_rand($statusIds)];

        // Buat 5 data acak
        $data = [];

        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'id'             => Str::uuid(),
                'ms_pegawai_id'  => $randomPegawaiId(),
                'ms_status_id'   => $randomStatusId(),   // ← perbaikan: gunakan kolom ms_status_id konsisten
                'nomor'          => $i,
                'dibuat_oleh'    => 'admin',
                'diupdate_oleh'  => 'admin',
                'tgl_dibuat'     => $now,
                'tgl_diupdate'   => $now,
                'status'         => 'aktif',
            ];
        }

        // Masukkan ke tabel
        DB::table('role_akses_status')->insert($data);
    }
}
