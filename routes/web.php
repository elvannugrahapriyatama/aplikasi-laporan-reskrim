<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pelapor\PelaporDashboardController;
use App\Http\Controllers\Pelapor\PelaporLaporanController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Petugas\PetugasLaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/pelapor/login');
});

// ==================== AUTH ====================
Route::get('/pelapor/login', [AuthController::class, 'showLoginPelapor'])->name('pelapor.login');
Route::get('/petugas/login', [AuthController::class, 'showLoginPetugas'])->name('petugas.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/pelapor/register', [AuthController::class, 'showRegisterPelapor'])->name('pelapor.register');
Route::post('/pelapor/register', [AuthController::class, 'registerPelapor']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== PELAPOR ====================
Route::prefix('pelapor')->middleware(['auth', 'role:pelapor'])->group(function () {
    Route::get('/dashboard', [PelaporDashboardController::class, 'index'])->name('pelapor.dashboard');
    Route::get('/laporan', [PelaporLaporanController::class, 'index'])->name('pelapor.laporan.index');
    Route::get('/laporan/create', [PelaporLaporanController::class, 'create'])->name('pelapor.laporan.create');
    Route::post('/laporan', [PelaporLaporanController::class, 'store'])->name('pelapor.laporan.store');
    Route::get('/laporan/{laporan}', [PelaporLaporanController::class, 'show'])->name('pelapor.laporan.show');
    Route::get('/laporan/{laporan}/cetak', [PelaporLaporanController::class, 'cetak'])->name('pelapor.laporan.cetak');
});

// ==================== PETUGAS ====================
Route::prefix('petugas')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');
    Route::get('/laporan', [PetugasLaporanController::class, 'index'])->name('petugas.laporan.index');
    Route::get('/laporan/{laporan}', [PetugasLaporanController::class, 'show'])->name('petugas.laporan.show');
    Route::get('/laporan/{laporan}/cetak', [PetugasLaporanController::class, 'cetak'])->name('petugas.laporan.cetak');

    // SEMUA MENGGUNAKAN GET (BISA DIAKSES LANGSUNG)
    Route::get('/laporan/{laporan}/terima', [PetugasLaporanController::class, 'terima'])->name('petugas.laporan.terima');
    Route::get('/laporan/{laporan}/proses', [PetugasLaporanController::class, 'proses'])->name('petugas.laporan.proses');
    Route::get('/laporan/{laporan}/selesai', [PetugasLaporanController::class, 'selesai'])->name('petugas.laporan.selesai');
    Route::get('/laporan/{laporan}/tolak', [PetugasLaporanController::class, 'tolak'])->name('petugas.laporan.tolak');
});
