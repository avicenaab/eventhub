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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('nama_event');
        $table->text('deskripsi')->nullable();
        $table->dateTime('tanggal_mulai');
        $table->dateTime('tanggal_selesai')->nullable();
        $table->string('lokasi');
        $table->unsignedInteger('kuota');
        $table->decimal('biaya', 12, 2)->default(0);
        $table->string('status_event')->default('draft');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
