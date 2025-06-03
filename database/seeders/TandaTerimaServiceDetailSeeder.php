<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\TrTandaTerimaServiceHeader;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TandaTerimaServiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $allTandaTerimaHeaderIds = TrTandaTerimaServiceHeader::all()->pluck('id')->toArray();
        $allBarangIds = DB::table('ms_barang')->pluck('id')->toArray();
        $allRakIds = DB::table('ms_Rak')->pluck('id')->toArray();

        $getRandomTandaTerimaHeaderId = function () use ($allTandaTerimaHeaderIds) {
            return $allTandaTerimaHeaderIds[array_rand($allTandaTerimaHeaderIds)];
        };

        $getRandomBarangId = function () use ($allBarangIds) {
            return $allBarangIds[array_rand($allBarangIds)];
        };

        $getRandomRakId = function () use ($allRakIds) {
            return $allRakIds[array_rand($allRakIds)];
        };

        DB::table('tr_tanda_terima_service_detail')->insert([
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'tr_tanda_terima_service_header_id' => $getRandomTandaTerimaHeaderId(),
                'ms_barang_id' => $getRandomBarangId(),
                'ms_rak_id' => $getRandomRakId(),
                'catatan' => 'Kerusakan detail ',
                'qty' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ]
        ]);
    }
}
