<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


// --- Halaman Publik (Tanpa Login) ---
// Hanya halaman info yang TIDAK memerlukan sesi login
Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('/faq', [AppController::class, 'showFaq'])->name('faq');
Route::get('/kontak', [AppController::class, 'showKontak'])->name('kontak.form');

// POST Kontak (Tidak memerlukan Auth)
// Route::post('/kontak', [AppController::class, 'sendKontak'])->name('kontak.send');


// --- Otentikasi Tunggal (Login/Register/Logout) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ====================================================================
// AREA DILINDUNGI (Wajib Login)
// ====================================================================

Route::middleware('auth')->group(function () {

    // Rute Magang (Pendaftaran) - Dipindahkan ke sini agar wajib login
    Route::get('/daftar', [AppController::class, 'showDaftar'])->name('daftar.form');
    Route::post('/daftar', [AppController::class, 'storeDaftar'])->name('daftar.store');

    // 1. DASHBOARD PELAMAR/UMUM
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', function () {
            return view('auth.dashboard_umum');
        })->name('user.dashboard');

        // Cek Status Magang (menggunakan email dari sesi)
        Route::get('/status', [AppController::class, 'showStatus'])->name('status.show');
    });

    // 2. DASHBOARD ADMIN
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // PERBAIKAN: Menghapus 'uri:'
        Route::post('/applicant/{id}/process', [AdminController::class, 'processApplicant'])->name('admin.applicant.process');

        Route::get('/download/{fileType}/{id}', [AdminController::class, 'downloadFile'])->name('admin.download.file');
    });
});
