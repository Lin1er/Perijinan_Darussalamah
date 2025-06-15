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
        Schema::create('ijins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')
                ->constrained('santris');
            $table->string('alasan');
            $table->date('tanggal_jemput');
            $table->date('tanggal_kembali');
            $table->date('tanggal_telat')
                ->nullable();
            $table->string('status')->default('pending'); // 'pending', 'approved', 'rejected'
            $table->string('lampiran');
            $table->string('catatan')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ijins');
    }
};
