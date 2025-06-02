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
        Schema::create('ms_cabang_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ms_cabang_id');
            $table->foreign('ms_cabang_id')->references('id')->on('ms_cabang')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('ms_pegawai_id');
            $table->foreign('ms_pegawai_id')->references('id')->on('ms_pegawai')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('ms_cabang');
    }
};
