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
        //
        Schema::create('magang_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 150);
            $table->string('asal_institusi', 150);
            $table->string('program_studi', 100);
            $table->string('email', 100)->unique();
            $table->string('nomor_hp', 20);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            // $table->enum('pilihan_divisi', ['ptip', 'kepegawaian', 'keuangan', 'hukum', 'umum']);
            $table->string('surat_pengantar_path'); // Dari pendaftar
            
            // --- Kolom Admin Decision ---
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->string('alasan_admin', 500)->nullable();
            $table->timestamp('tanggal_keputusan')->nullable();
            $table->string('surat_keputusan_path')->nullable(); // Dari admin
            // ----------------------------------------
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('magang_applicants');
    }
};