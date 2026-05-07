<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul_laporan');
            $table->enum('jenis_kejahatan', [
                'pencurian', 'penganiayaan', 'penipuan', 'pengerusakan', 
                'narkoba', 'kekerasan_dalam_rumah_tangga', 'pencabulan',
                'lalu_lintas', 'lainnya'
            ]);
            $table->text('deskripsi_kejadian');
            $table->text('kronologi')->nullable();
            $table->datetime('waktu_kejadian');
            $table->string('tempat_kejadian');
            $table->string('korban_nama')->nullable();
            $table->string('korban_alamat')->nullable();
            $table->string('pelaku_nama')->nullable();
            $table->text('ciri_pelaku')->nullable();
            $table->string('barang_bukti')->nullable();
            $table->enum('status', ['menunggu', 'diverifikasi', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('catatan_petugas')->nullable();
            $table->datetime('tanggal_verifikasi')->nullable();
            $table->foreignId('verifikator_id')->nullable()->constrained('users');
            
            $table->text('hasil_penanganan')->nullable();
            $table->datetime('target_selesai')->nullable();
            $table->json('tracking_history')->nullable();
            $table->foreignId('penerima_id')->nullable()->constrained('users');
            $table->string('nama_penerima')->nullable();
            $table->datetime('tanggal_diterima')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};