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
        Schema::create('tr_sp_ambil_rak_polimorf', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tr_sp_ambil_rak_polimorf_id');
            $table->string('tr_sp_ambil_rak_polimorf_tipe');
            $table->string('nama', 255);
            $table->integer('nomor');
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
        Schema::dropIfExists('tr_sp_ambil_rak_header_polimorf');
    }
};
