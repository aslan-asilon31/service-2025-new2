<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;

// Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/', function () {
    return redirect()->route('admin_login');
});
Route::get('/about', [FrontController::class, 'about'])->name('about');

// User
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profile_submit'])->name('profile_submit');
});
// Route::get('/registration', [UserController::class, 'registration'])->name('registration');
// Route::post('/registration', [UserController::class, 'registration_submit'])->name('registration_submit');
// Route::get('/registration-verify/{token}/{email}', [UserController::class, 'registration_verify'])->name('registration_verify');
// Route::get('/login', [UserController::class, 'login'])->name('login');
// Route::post('/login', [UserController::class, 'login_submit'])->name('login_submit');
// Route::get('/forget-password', [UserController::class, 'forget_password'])->name('forget_password');
// Route::post('/forget-password', [UserController::class, 'forget_password_submit'])->name('forget_password_submit');
// Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('reset_password');
// Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('reset_password_submit');
// Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/403', function () {
    return view('components.errors.missing-permission');
})->name('forbidden');

// Admin
Route::middleware('admin')->group(function () {

    Route::get('/dashboard', \App\Livewire\Welcome::class)->name('admin_dashboard');
    // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminController::class, 'profile_submit'])->name('admin_profile_submit');
    Route::get('/dashboard1', \App\Livewire\DashboardResources\DashboardList::class)->name('dashboard.list');

    Route::get('/pelanggan', \App\Livewire\MsPelangganResources\PelangganList::class)->name('pelanggan.list');
    Route::get('/pelanggan/create', \App\Livewire\MsPelangganResources\PelangganCrud::class)->name('pelanggan.create');
    Route::get('/pelanggan/edit/{id}', \App\Livewire\MsPelangganResources\PelangganCrud::class)->name('pelanggan.edit');
    Route::get('/pelanggan/show/{id}', \App\Livewire\MsPelangganResources\PelangganCrud::class)->name('pelanggan.show');

    Route::get('/permission', \App\Livewire\Permission\PermissionList::class)->name('permission.list');
    Route::get('/barang', \App\Livewire\MsBarangResources\MsBarangList::class)->name('barang.list');
    Route::get('/barang/buat', \App\Livewire\MsBarangResources\MsBarangCrud::class)->name('barang.buat');

    // Route::get('/barang/edit/{id}', \App\Livewire\MsBarangResources\BarangCrud::class)->name('barang.edit');
    // Route::get('/barang/show/{id}/{readonly}', \App\Livewire\MsBarangResources\BarangCrud::class)->where('readonly', 'readonly')->name('barang.show');

    Route::get('/cabang', \App\Livewire\MsCabangResources\MsCabangList::class)->name('cabang.list');
    Route::get('/cabang/create', \App\Livewire\MsCabangResources\MsCabangCrud::class)->name('cabang.create');

    Route::get('/gudang', \App\Livewire\MsGudangResources\MsGudangList::class)->name('gudang.list');

    Route::get('/pegawai', \App\Livewire\MsPegawaiResources\MsPegawaiList::class)->name('pegawai.list');
    Route::get('/pegawai/buat', \App\Livewire\MsPegawaiResources\MsPegawaiCrud::class)->name('pegawai.buat');
    Route::get('/pegawai/edit/{id}', \App\Livewire\MsPegawaiResources\MsPegawaiCrud::class)->name('pegawai.ubah');
    Route::get('/pegawai/show/{id}', \App\Livewire\MsPegawaiResources\MsPegawaiCrud::class)->name('pegawai.tampil');

    Route::get('/rak', \App\Livewire\MsRakResources\MsRakList::class)->name('rak.list');
    Route::get('/rak-kategori', \App\Livewire\MsRakKategoriResources\MsRakKategoriList::class)->name('rak-kategori.list');


    Route::get('/tanda-terima-service', \App\Livewire\TandaTerimaServiceResources\TandaTerimaServiceList::class)->name('rak-kategori.list');
});

Route::get('/', function () {
    return redirect()->route('admin_login');
});
Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');




// Pegawai
Route::middleware('pegawai')->prefix('pegawai')->group(function () {
    Route::post('/profile', [AdminController::class, 'profile_submit'])->name('admin_profile_submit');
    Route::get('/dashboard1', \App\Livewire\DashboardResources\DashboardList::class)->name('dashboard.list');
});

Route::prefix('pegawai')->group(function () {
    Route::get('/dashboard1', \App\Livewire\DashboardResources\DashboardList::class)->name('pegawai-dashboard.list');
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('pegawai_login');


    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});
