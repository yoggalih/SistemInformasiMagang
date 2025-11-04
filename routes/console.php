<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// [BARU] Import kelas yang diperlukan untuk pengujian email
use App\Mail\ApplicationStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Models\MagangApplicants;

// Custom command untuk menguji pengiriman email
Artisan::command('mail:send-test {email}', function ($email) {
    // 1. Dapatkan data pelamar dummy (ambil yang pertama, atau buat dummy object)
    $applicant = MagangApplicants::first();

    if (!$applicant) {
        // Jika tidak ada data di DB, buat objek MagangApplicants dummy agar tidak error.
        $applicant = new MagangApplicants([
            // Penting: Gunakan nama properti yang benar
            'nama_lengkap' => 'Tester Laravel',
            'email' => $email
        ]);
        // Tentukan ID 1 untuk mencegah error pada Mailable jika Mailable memerlukannya.
        $applicant->id = 1;
    }

    try {
        // 2. Kirim email status DITERIMA ke alamat yang dimasukkan di console
        Mail::to($email)->send(new ApplicationStatusMail($applicant, 'accepted'));

        $this->info("✅ Email tes BERHASIL dikirim ke {$email}!");
        $this->info('Subjek: Pemberitahuan Status Magang: DITERIMA');
    } catch (\Exception $e) {
        $this->error("❌ Email tes GAGAL dikirim ke {$email}.");
        $this->error("Detail Error: " . $e->getMessage());
        $this->warn("Pastikan Anda sudah menjalankan 'php artisan config:clear' dan konfigurasi MAIL di .env sudah benar (termasuk tanda kutip pada password).");
    }
})->purpose('Menguji koneksi SMTP dengan mengirim email tes.');

// Command bawaan Laravel
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
