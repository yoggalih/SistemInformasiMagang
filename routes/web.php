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

// --- Fitur Lupa Password (Placeholder) ---
Route::get('forgot-password', function () {
    // Menampilkan view formulir lupa password
    return view('auth.forgot-password');
})->name('password.request');
Route::post('forgot-password', function () {
    // Dummy logic, implementasi penuh memerlukan Laravel's mail/notification setup
    return back()->with('status', 'Tautan reset password telah dikirim ke email Anda.');
})->name('password.email');
// ----------------------------------------


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

        // Tambahan fitur: Pengaturan Profil (Nama, Email & Password)
        Route::get('/profile', [AuthController::class, 'showProfileForm'])->name('user.profile.show');
        Route::post('/profile', [AuthController::class, 'updateProfile'])->name('user.profile.update');
    });

    // 2. DASHBOARD ADMIN
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::post('/applicant/{id}/process', [AdminController::class, 'processApplicant'])->name('admin.applicant.process');

        // [BARU] Rute untuk Menghapus Pelamar
        Route::post('/applicant/{id}/delete', [AdminController::class, 'deleteApplicant'])->name('admin.applicant.delete');

        Route::get('/download/{fileType}/{id}', [AdminController::class, 'downloadFile'])->name('admin.download.file');
    });
});
