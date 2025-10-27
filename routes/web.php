<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;


// --- Halaman Tampilan (GET Routes) ---

// 1. Halaman Utama
Route::get('/', [AppController::class, 'index'])->name('home');

// 2. Halaman Divisi (Contoh: /divisi/ptip)
Route::get('/divisi/{divisi}', [AppController::class, 'showDivisi'])->name('divisi.show');
Route::get('/divisi', function () {
    return redirect()->route('divisi.show', ['divisi' => 'ptip']); // Redirect ke divisi default
});

// 3. Halaman Daftar Magang
Route::get('/daftar', [AppController::class, 'showDaftar'])->name('daftar.form');

// 4. Halaman FAQ
Route::get('/faq', [AppController::class, 'showFaq'])->name('faq');

// 5. Halaman Kontak
Route::get('/kontak', [AppController::class, 'showKontak'])->name('kontak.form');


// --- Pemrosesan Form (POST Routes) ---

// 3. POST Pendaftaran Magang
Route::post('/daftar', [AppController::class, 'storeDaftar'])->name('daftar.store');

// 5. POST Kirim Pesan Kontak
Route::post('/kontak', [AppController::class, 'sendKontak'])->name('kontak.send');
