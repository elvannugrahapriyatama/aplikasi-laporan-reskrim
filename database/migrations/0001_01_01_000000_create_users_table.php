<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['petugas', 'pelapor'])->default('pelapor');
            $table->string('no_telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_identitas')->nullable();
            $table->string('nip')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('foto')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};