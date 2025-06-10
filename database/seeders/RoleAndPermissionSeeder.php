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
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Membuat Permissions
        $barangList = Permission::create(['name' => 'barang-list']);
        $barangBuat = Permission::create(['name' => 'barang-buat']);
        $barangSimpan = Permission::create(['name' => 'barang-simpan']);
        $barangUbah = Permission::create(['name' => 'barang-ubah']);
        $barangUpdate = Permission::create(['name' => 'barang-update']);
        $barangHapus = Permission::create(['name' => 'barang-hapus']);
        $barangTampil = Permission::create(['name' => 'barang-tampil']);

        $cabangList = Permission::create(['name' => 'cabang-list']);
        $cabangBuat = Permission::create(['name' => 'cabang-buat']);
        $cabangSimpan = Permission::create(['name' => 'cabang-simpan']);
        $cabangUbah = Permission::create(['name' => 'cabang-ubah']);
        $cabangUpdate = Permission::create(['name' => 'cabang-update']);
        $cabangHapus = Permission::create(['name' => 'cabang-hapus']);
        $cabangTampil = Permission::create(['name' => 'cabang-tampil']);


        $gudangList = Permission::create(['name' => 'gudang-list']);
        $gudangBuat = Permission::create(['name' => 'gudang-buat']);
        $gudangSimpan = Permission::create(['name' => 'gudang-simpan']);
        $gudangUbah = Permission::create(['name' => 'gudang-ubah']);
        $gudangUpdate = Permission::create(['name' => 'gudang-update']);
        $gudangHapus = Permission::create(['name' => 'gudang-hapus']);
        $gudangTampil = Permission::create(['name' => 'gudang-tampil']);


        $pegawaiList = Permission::create(['name' => 'pegawai-list']);
        $pegawaiBuat = Permission::create(['name' => 'pegawai-buat']);
        $pegawaiSimpan = Permission::create(['name' => 'pegawai-simpan']);
        $pegawaiUbah = Permission::create(['name' => 'pegawai-ubah']);
        $pegawaiUpdate = Permission::create(['name' => 'pegawai-update']);
        $pegawaiHapus = Permission::create(['name' => 'pegawai-hapus']);
        $pegawaiTampil = Permission::create(['name' => 'pegawai-tampil']);


        $pelangganList = Permission::create(['name' => 'pelanggan-list']);
        $pelangganBuat = Permission::create(['name' => 'pelanggan-buat']);
        $pelangganSimpan = Permission::create(['name' => 'pelanggan-simpan']);
        $pelangganUbah = Permission::create(['name' => 'pelanggan-ubah']);
        $pelangganUpdate = Permission::create(['name' => 'pelanggan-update']);
        $pelangganHapus = Permission::create(['name' => 'pelanggan-hapus']);
        $pelangganTampil = Permission::create(['name' => 'pelanggan-tampil']);


        $rakList = Permission::create(['name' => 'rak-list']);
        $rakBuat = Permission::create(['name' => 'rak-buat']);
        $rakSimpan = Permission::create(['name' => 'rak-simpan']);
        $rakUbah = Permission::create(['name' => 'rak-ubah']);
        $rakUpdate = Permission::create(['name' => 'rak-update']);
        $rakHapus = Permission::create(['name' => 'rak-hapus']);
        $rakTampil = Permission::create(['name' => 'rak-tampil']);


        $rakKategoriList = Permission::create(['name' => 'rak_kategori-list']);
        $rakKategoriBuat = Permission::create(['name' => 'rak_kategori-buat']);
        $rakKategoriSimpan = Permission::create(['name' => 'rak_kategori-simpan']);
        $rakKategoriUbah = Permission::create(['name' => 'rak_kategori-ubah']);
        $rakKategoriUpdate = Permission::create(['name' => 'rak_kategori-update']);
        $rakKategoriHapus = Permission::create(['name' => 'rak_kategori-hapus']);
        $rakKategoriTampil = Permission::create(['name' => 'rak_kategori-tampil']);


        $tandaTerimaServiceList = Permission::create(['name' => 'tanda_terima_service-list']);
        $tandaTerimaServiceBuat = Permission::create(['name' => 'tanda_terima_service-buat']);
        $tandaTerimaServiceSimpan = Permission::create(['name' => 'tanda_terima_service-simpan']);
        $tandaTerimaServiceUbah = Permission::create(['name' => 'tanda_terima_service-ubah']);
        $tandaTerimaServiceUpdate = Permission::create(['name' => 'tanda_terima_service-update']);
        $tandaTerimaServiceHapus = Permission::create(['name' => 'tanda_terima_service-hapus']);
        $tandaTerimaServiceTampil = Permission::create(['name' => 'tanda_terima_service-tampil']);


        $roleList = Permission::create(['name' => 'role-list']);
        $roleBuat = Permission::create(['name' => 'role-buat']);
        $roleSimpan = Permission::create(['name' => 'role-simpan']);
        $roleUbah = Permission::create(['name' => 'role-ubah']);
        $roleUpdate = Permission::create(['name' => 'role-update']);
        $roleHapus = Permission::create(['name' => 'role-hapus']);
        $roleTampil = Permission::create(['name' => 'role-tampil']);


        $permissionList = Permission::create(['name' => 'permission-list']);
        $permissionBuat = Permission::create(['name' => 'permission-buat']);
        $permissionSimpan = Permission::create(['name' => 'permission-simpan']);
        $permissionUbah = Permission::create(['name' => 'permission-ubah']);
        $permissionUpdate = Permission::create(['name' => 'permission-update']);
        $permissionHapus = Permission::create(['name' => 'permission-hapus']);
        $permissionTampil = Permission::create(['name' => 'permission-tampil']);


        // Membuat Roles
        $developerRole = Role::create(['name' => 'developer']);
        $developerRole->givePermissionTo([
            $barangList,
            $barangBuat,
            $barangSimpan,
            $barangUbah,
            $barangUpdate,
            $barangHapus,
            $barangTampil,
            $cabangList,
            $cabangBuat,
            $cabangUbah,
            $cabangHapus,
            $cabangTampil,
            $gudangList,
            $gudangBuat,
            $gudangUbah,
            $gudangHapus,
            $gudangTampil,
            $pegawaiList,
            $pegawaiBuat,
            $pegawaiUbah,
            $pegawaiHapus,
            $pegawaiTampil,
            $pelangganList,
            $pelangganBuat,
            $pelangganUbah,
            $pelangganHapus,
            $pelangganTampil,
            $rakList,
            $rakBuat,
            $rakUbah,
            $rakHapus,
            $rakTampil,
            $rakKategoriList,
            $rakKategoriBuat,
            $rakKategoriUbah,
            $rakKategoriHapus,
            $rakKategoriTampil,
            $tandaTerimaServiceList,
            $tandaTerimaServiceBuat,
            $tandaTerimaServiceUbah,
            $tandaTerimaServiceHapus,
            $tandaTerimaServiceTampil,
            $roleList,
            $roleBuat,
            $roleUbah,
            $roleHapus,
            $roleTampil,
            $permissionList,
            $permissionBuat,
            $permissionUbah,
            $permissionHapus,
            $permissionTampil,
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            $barangList,
            $barangBuat,
            $barangUbah,
            $barangHapus,
            $barangTampil,
            $cabangList,
            $cabangBuat,
            $cabangUbah,
            $cabangHapus,
            $cabangTampil,
            $gudangList,
            $gudangBuat,
            $gudangUbah,
            $gudangHapus,
            $gudangTampil,
            $pegawaiList,
            $pegawaiBuat,
            $pegawaiUbah,
            $pegawaiHapus,
            $pegawaiTampil,
            $pelangganList,
            $pelangganBuat,
            $pelangganUbah,
            $pelangganHapus,
            $pelangganTampil,
            $rakList,
            $rakBuat,
            $rakUbah,
            $rakHapus,
            $rakTampil,
            $rakKategoriList,
            $rakKategoriBuat,
            $rakKategoriUbah,
            $rakKategoriHapus,
            $rakKategoriTampil,
            $tandaTerimaServiceList,
            $tandaTerimaServiceBuat,
            $tandaTerimaServiceUbah,
            $tandaTerimaServiceHapus,
            $tandaTerimaServiceTampil,
            $roleList,
            $roleBuat,
            $roleUbah,
            $roleHapus,
            $roleTampil,
            $permissionList,
            $permissionBuat,
            $permissionUbah,
            $permissionHapus,
            $permissionTampil,
        ]);

        $supervisorRole = Role::create(['name' => 'supervisor']);
        $supervisorRole->givePermissionTo([
            $barangList,
            $barangTampil,
            $cabangList,
            $cabangTampil,
            $gudangList,
            $gudangTampil,
            $pegawaiList,
            $pegawaiTampil,
            $pelangganList,
            $pelangganTampil,
            $rakList,
            $rakTampil,
            $rakKategoriList,
            $rakKategoriTampil,
            $tandaTerimaServiceList,
            $tandaTerimaServiceTampil,
        ]);



        $headOfficeRole = Role::create(['name' => 'head-office']);
        $headOfficeRole->givePermissionTo([
            $barangList,
            $barangBuat,
            $barangUbah,
            $barangHapus,
            $barangTampil,
            $cabangList,
            $cabangBuat,
            $cabangUbah,
            $cabangHapus,
            $cabangTampil,
            $gudangList,
            $gudangBuat,
            $gudangUbah,
            $gudangHapus,
            $gudangTampil,
            $pegawaiList,
            $pegawaiBuat,
            $pegawaiUbah,
            $pegawaiHapus,
            $pegawaiTampil,
            $pelangganList,
            $pelangganBuat,
            $pelangganUbah,
            $pelangganHapus,
            $pelangganTampil,
            $rakList,
            $rakBuat,
            $rakUbah,
            $rakHapus,
            $rakTampil,
            $rakKategoriList,
            $rakKategoriBuat,
            $rakKategoriUbah,
            $rakKategoriHapus,
            $rakKategoriTampil,
            $tandaTerimaServiceList,
            $tandaTerimaServiceBuat,
            $tandaTerimaServiceUbah,
            $tandaTerimaServiceHapus,
            $tandaTerimaServiceTampil,
        ]);

        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo([
            $barangList,
            $barangBuat,
            $barangUbah,
            $barangTampil,
            $cabangList,
            $cabangBuat,
            $cabangUbah,
            $cabangTampil,
            $gudangList,
            $gudangBuat,
            $gudangUbah,
            $gudangTampil,
            $pegawaiList,
            $pegawaiBuat,
            $pegawaiUbah,
            $pegawaiTampil,
            $pelangganList,
            $pelangganBuat,
            $pelangganUbah,
            $pelangganTampil,
            $rakList,
            $rakBuat,
            $rakUbah,
            $rakTampil,
            $rakKategoriList,
            $rakKategoriBuat,
            $rakKategoriUbah,
            $rakKategoriTampil,
            $tandaTerimaServiceList,
            $tandaTerimaServiceBuat,
            $tandaTerimaServiceUbah,
            $tandaTerimaServiceTampil,
        ]);

        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo([
            $barangList,
            $barangBuat,
            $barangTampil,
            $cabangList,
            $cabangBuat,
            $cabangTampil,
            $gudangList,
            $gudangBuat,
            $gudangTampil,
            $pegawaiList,
            $pegawaiBuat,
            $pegawaiTampil,
            $pelangganList,
            $pelangganBuat,
            $pelangganTampil,
            $rakList,
            $rakBuat,
            $rakTampil,
            $rakKategoriList,
            $rakKategoriBuat,
            $rakKategoriTampil,
            $tandaTerimaServiceList,
            $tandaTerimaServiceBuat,
            $tandaTerimaServiceTampil,
        ]);

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
