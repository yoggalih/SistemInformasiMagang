<?php
// File: app/Http/Controllers/AppController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MagangApplicants;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewApplicationNotification;

class AppController extends Controller
{
    /**
     * Menampilkan halaman Beranda.
     */
    public function index()
    {
        // Mendapatkan tanggal hari ini
        $today = Carbon::today();

        // 1. Mengambil daftar pelamar yang SEDANG MAGANG saat ini
        $currentInterns = MagangApplicants::where('status', 'accepted')
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->select('nama_lengkap', 'program_studi', 'asal_institusi', 'tanggal_mulai', 'tanggal_selesai')
            ->orderBy('tanggal_mulai', 'asc')
            ->get()
            ->map(function ($intern) {
                $intern->status_desc = 'Sedang Berlangsung';
                $intern->status_color = 'green'; // Untuk visualisasi di tabel
                return $intern;
            });

        // 2. Mengambil daftar pelamar yang SUDAH SELESAI MAGANG (10 data terakhir)
        $finishedInterns = MagangApplicants::where('status', 'accepted')
            ->whereDate('tanggal_selesai', '<', $today)
            ->select('nama_lengkap', 'program_studi', 'asal_institusi', 'tanggal_mulai', 'tanggal_selesai')
            ->orderBy('tanggal_selesai', 'desc')
            ->take(10) // Batasi hanya 10 data terakhir yang selesai
            ->get()
            ->map(function ($intern) {
                $intern->status_desc = 'Sudah Selesai';
                $intern->status_color = 'gray'; // Untuk visualisasi di tabel
                return $intern;
            });

        // 3. Gabungkan kedua koleksi, diurutkan berdasarkan tanggal mulai (atau selesai)
        $allInterns = $currentInterns->merge($finishedInterns)->sortByDesc('tanggal_mulai');

        // Kirim koleksi gabungan ke view home
        return view('home', compact('allInterns'));
    }

    /**
     * Menampilkan formulir pendaftaran magang.
     */
    public function showDaftar()
    {
        // Mendapatkan email user yang sedang login jika ada
        $userEmail = Auth::check() ? Auth::user()->email : null;

        // Mencari lamaran terakhir dari user tersebut
        $lastApplicant = $userEmail ? MagangApplicants::where('email', $userEmail)->latest()->first() : null;

        // Cek Cooldown (Jika lamaran terakhir ditolak)
        if ($lastApplicant && $lastApplicant->status === 'rejected') {
            $alasanAdmin = $lastApplicant->alasan_admin;
            // Mencari tag [COOLDOWN:XX]
            if (preg_match('/\[COOLDOWN:(\d+)\]/i', $alasanAdmin, $matches)) {
                $cooldownDays = (int)$matches[1];
                $cooldownUntil = Carbon::parse($lastApplicant->tanggal_keputusan)->addDays($cooldownDays);

                if (Carbon::now()->lt($cooldownUntil)) {
                    // Masih dalam masa cooldown
                    return redirect()->route('home')->with('error', 'Anda masih dalam masa tunggu (' . $cooldownDays . ' hari) setelah penolakan terakhir. Anda dapat mendaftar lagi pada tanggal ' . $cooldownUntil->format('d F Y') . '.');
                }
            }
        }

        return view('daftar');
    }

    /**
     * Menampilkan halaman kontak.
     */
    public function showKontak()
    {
        return view('kontak');
    }

    /**
     * Menampilkan halaman FAQ.
     */
    public function showFAQ()
    {
        return view('faq');
    }

    // ===========================================
    // --- VALIDASI DAN LOGIKA BARU ---
    // ===========================================

    /**
     * Metode untuk memeriksa cooldown (dipanggil dari validasi).
     */
    protected function checkCooldown($email, $fail)
    {
        $lastApplicant = MagangApplicants::where('email', $email)->latest()->first();

        if ($lastApplicant) {
            // Cek jika statusnya masih pending (belum diproses)
            if ($lastApplicant->status === 'pending') {
                return $fail("Anda sudah memiliki lamaran yang sedang menunggu keputusan (Status: Pending). Anda tidak dapat mengajukan lamaran baru saat ini.");
            }

            // Cek Cooldown jika statusnya rejected
            if ($lastApplicant->status === 'rejected') {
                $alasanAdmin = $lastApplicant->alasan_admin;
                if (preg_match('/\[COOLDOWN:(\d+)\]/i', $alasanAdmin, $matches)) {
                    $cooldownDays = (int)$matches[1];
                    $cooldownUntil = Carbon::parse($lastApplicant->tanggal_keputusan)->addDays($cooldownDays);

                    if (Carbon::now()->lt($cooldownUntil)) {
                        return $fail("Anda masih dalam masa tunggu (" . $cooldownDays . " hari) setelah penolakan terakhir. Anda dapat mendaftar lagi pada tanggal " . $cooldownUntil->format('d F Y') . ".");
                    }
                }
            }
        }
    }


    /**
     * Memproses permintaan pendaftaran magang (POST).
     */
    public function storeDaftar(Request $request)
    {
        $isLoggedIn = Auth::check();

        // 1. Aturan validasi yang diperbarui
        $validationRules = [
            'nama_lengkap' => 'required|string|max:150',
            'asal_institusi' => 'required|string|max:150',
            'program_studi' => 'required|string|max:100',
            'nomor_hp' => 'required|string|max:20',
            'tanggal_mulai' => 'required|date|after_or_equal:today', // Validasi tanggal
            'tanggal_selesai' => 'required|date|after:tanggal_mulai', // Validasi tanggal
            'surat_pengantar' => 'required|file|mimes:pdf|max:2048', // Maks 2MB
        ];

        // Jika TIDAK login, email wajib diisi, dan jalankan Cooldown Check
        if (!$isLoggedIn) {
            $validationRules['email'] = ['required', 'email', 'max:255', function ($attribute, $value, $fail) {
                $this->checkCooldown($value, $fail);
            }];
        } else {
            // Jika login, cek hanya apakah sudah ada lamaran pending/cooldown dari user ini
            $validationRules['email'] = ['nullable', 'email', 'max:255', function ($attribute, $value, $fail) {
                $this->checkCooldown(Auth::user()->email, $fail);
            }];
        }

        // Jalankan Validasi Data
        $request->validate($validationRules);

        // 2. Tentukan Email
        $email = $isLoggedIn ? Auth::user()->email : $request->email;

        // 3. Cek Duplikasi
        if (MagangApplicants::where('email', $email)->where('status', 'accepted')->exists()) {
            return redirect()->back()->with('error', 'Anda sudah memiliki lamaran yang diterima.')->withInput();
        }

        // 4. Upload File PDF
        $path = $request->file('surat_pengantar')->store('public/surat_pengantar');

        // 5. Simpan Data ke Database
        $applicant = MagangApplicants::create([
            'nama_lengkap' => $request->nama_lengkap,
            'asal_institusi' => $request->asal_institusi,
            'program_studi' => $request->program_studi,
            'email' => $email, // Menggunakan email yang sudah ditentukan
            'nomor_hp' => $request->nomor_hp,
            'tanggal_mulai' => $request->tanggal_mulai, // Disimpan
            'tanggal_selesai' => $request->tanggal_selesai, // Disimpan
            'surat_pengantar_path' => $path,
            'status' => 'pending',
        ]);

        // LOGIKA KIRIM NOTIFIKASI KE ADMIN
        try {
            $adminEmail = 'admin@pn-klaten.test';
            $adminUser = User::where('role', 'admin')->first();
            if ($adminUser) {
                $adminEmail = $adminUser->email;
            }

            Mail::to($adminEmail)->send(new NewApplicationNotification($applicant));

            $emailMessage = "Notifikasi kepada admin **berhasil dikirim**.";
        } catch (\Exception $e) {
            $emailMessage = "Notifikasi kepada admin **gagal dikirim**.";
        }

        // 6. Redirect dengan pesan sukses
        $request->session()->put('applicant_email', $email);

        return redirect()->route('status.show')
            ->with('success', 'Pendaftaran magang berhasil diajukan! Silakan tunggu konfirmasi dari admin. ' . $emailMessage);
    }

    /**
     * Proses Kirim Pesan Kontak (POST).
     */
    public function sendKontak(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'pesan' => 'required|string|max:500',
        ]);

        // 2. Logika Pengiriman Email (disimulasikan)

        return redirect('/kontak')->with('success', 'Pesan Anda berhasil terkirim. Kami akan merespons secepatnya!');
    }

    // ===========================================
    // --- FITUR CEK STATUS ---
    // ===========================================

    /**
     * Menampilkan form pencarian status (showStatusForm).
     */
    public function showStatus()
    {
        // Mendapatkan email dari user yang sedang login atau dari session
        $userEmail = Auth::check() ? Auth::user()->email : session('applicant_email');

        if (!$userEmail) {
            // Jika tidak ada email (misalnya, sesi hilang atau user belum daftar/login)
            return view('status_magang', ['applicant' => null, 'error' => 'Silakan masukkan email dan Nomor HP Anda untuk melihat status.']);
        }

        // Mencari data pendaftar di tabel magang_applicants menggunakan Email
        $applicant = MagangApplicants::where('email', $userEmail)->latest()->first();

        // Menggunakan view status_magang untuk menampilkan hasil
        return view('status_magang', compact('applicant'));
    }

    /**
     * Memproses pencarian status dan menampilkan hasilnya (checkStatus).
     */
    public function checkStatus(Request $request)
    {
        // Validasi input: Email harus ada di tabel magang_applicants, dan nomor_hp harus diisi
        $request->validate([
            'email' => 'required|email|exists:magang_applicants,email',
            'nomor_hp' => 'required|string|max:20',
        ], [
            'email.exists' => 'Email pendaftar tidak ditemukan di sistem kami.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        // Mencari data pendaftar berdasarkan kombinasi Email dan Nomor HP
        $applicant = MagangApplicants::where('email', $request->email)
            ->where('nomor_hp', $request->nomor_hp)
            ->first();

        // Jika kombinasi tidak cocok (security check)
        if (!$applicant) {
            return back()->withErrors(['lookup_fail' => 'Kombinasi Email dan Nomor HP tidak cocok. Harap periksa kembali data Anda.'])->withInput();
        }

        // Simpan email di session untuk user yang tidak login
        if (!Auth::check()) {
            $request->session()->put('applicant_email', $request->email);
        }

        // Tampilkan hasil di view yang sama
        return view('status_magang', compact('applicant'));
    }
}
