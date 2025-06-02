<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tr_sp_mutasi_gudang_terima_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tr_sp_mutasi_gudang_terima_detail_id');
            $table->foreign('tr_sp_mutasi_gudang_terima_detail_id', 'fk_tr_sp_mutasi_gudang_terima_detail_id')->references('id')->on('tr_sp_mutasi_gudang_terima_header')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('ms_barang_id');
            $table->foreign('ms_barang_id')->references('id')->on('ms_barang')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('ms_rak_id');
            $table->foreign('ms_rak_id')->references('id')->on('ms_rak')->onDelete('cascade')->onUpdate('cascade');

            $table->text('catatan')->nullable();

            $table->integer('qty');
            $table->string('dibuat_oleh', 255)->nullable()->index();
            $table->string('diupdate_oleh', 255)->nullable()->index();
            $table->timestamp('tgl_dibuat');
            $table->timestamp('tgl_diupdate');
            $table->string('status')->index()->default('aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_sp_mutasi_gudang_terima_detail');
    }
};
