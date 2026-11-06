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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_daftar');
            $table->unsignedBigInteger('peserta_id');
            $table->unsignedBigInteger('event_id');
            $table->string('status_pendaftaran')->default('menunggu');
            $table->string('status_pembayaran')->default('belum_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
