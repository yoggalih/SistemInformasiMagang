<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MagangApplicants;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    /**
     * Menampilkan halaman Beranda.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Menampilkan formulir pendaftaran magang.
     */
    public function showDaftar()
    {
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

    /**
     * Memproses permintaan pendaftaran magang (POST).
     */
    public function storeDaftar(Request $request)
    {
        $isLoggedIn = Auth::check();

        // Aturan validasi dasar
        $validationRules = [
            'nama_lengkap' => 'required|string|max:150',
            'asal_institusi' => 'required|string|max:150',
            'program_studi' => 'required|string|max:100',
            'nomor_hp' => 'required|string|max:20',
            'surat_pengantar' => 'required|file|mimes:pdf|max:2048', // Maks 2MB
        ];

        // Jika TIDAK login, email wajib diisi dan unik
        if (!$isLoggedIn) {
            $validationRules['email'] = 'required|email|unique:magang_applicants,email';
        }

        // 1. Validasi Data
        $request->validate($validationRules);

        // 2. Tentukan Email
        // Ambil dari sesi jika login, atau dari request jika tidak login
        $email = $isLoggedIn ? Auth::user()->email : $request->email;

        // 3. Cek apakah user yang login sudah pernah mendaftar (Mencegah duplikasi)
        if (MagangApplicants::where('email', $email)->exists()) {
            return redirect('/daftar')->with('error', 'Anda hanya dapat mengajukan pendaftaran magang sekali menggunakan email ini.')->withInput();
        }

        // 4. Upload File PDF
        $path = $request->file('surat_pengantar')->store('public/surat_pengantar');

        // 5. Simpan Data ke Database
        MagangApplicants::create([
            'nama_lengkap' => $request->nama_lengkap,
            'asal_institusi' => $request->asal_institusi,
            'program_studi' => $request->program_studi,
            'email' => $email, // Menggunakan email yang sudah ditentukan
            'nomor_hp' => $request->nomor_hp,
            'surat_pengantar_path' => $path,
        ]);

        // 6. Redirect dengan pesan sukses
        return redirect('/daftar')->with('success', 'Pendaftaran magang berhasil diajukan! Admin akan segera menghubungi Anda.');
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
    // --- FITUR CEK STATUS (BARU) ---
    // ===========================================

    /**
     * Menampilkan form pencarian status (showStatusForm).
     */
    public function showStatus()
    {
        // Mendapatkan email dari user yang sedang login
        $userEmail = Auth::user()->email;

        // Mencari data pendaftar di tabel magang_applicants menggunakan Email
        $applicant = MagangApplicants::where('email', $userEmail)->first();

        // Menggunakan view status_magang untuk menampilkan hasil
        // Jika $applicant ditemukan, tampilkan status. Jika tidak, tampilkan pesan belum daftar.
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

        // Tampilkan hasil di view yang sama
        return view('status_magang', compact('applicant'));
    }
}
