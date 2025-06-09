<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->name('api.msbarang.')->group(function () {
    Route::get('/barang', [\App\Http\Controllers\API\MsBarangResources\MsBarangController::class, 'index'])->name('list');
});
