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
        Schema::create('role_akses_status', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'fk_role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('ms_status_id');
            $table->foreign('ms_status_id', 'fk_ms_status_id')->references('id')->on('ms_status')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id', 'fk_permission_id')->references('id')->on('permissions')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('role_akses_status');
    }
};
