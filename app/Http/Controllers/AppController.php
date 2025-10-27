<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MagangApplicants;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    public function showDaftar()
    {
        return view('daftar');
    }

    public function showKontak()
    {
        return view('kontak');
    }

    public function showFAQ()
    {
        return view('faq');
    }

    public function showDivisi($divisi = 'ptip')
    {
        // Logika untuk menampilkan halaman divisi berdasarkan parameter
        return view('divisi.' . $divisi);
    }

    public function storeDaftar(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'asal_institusi' => 'required|string|max:150',
            'program_studi' => 'required|string|max:100',
            'email' => 'required|email|unique:magang_applicants,email',
            'nomor_hp' => 'required|string|max:20',
            'pilihan_divisi' => 'required|in:ptip,kepegawaian,keuangan,hukum,umum',
            'surat_pengantar' => 'required|file|mimes:pdf|max:2048', // Maks 2MB
        ]);

        // 2. Upload File PDF
        $path = $request->file('surat_pengantar')->store('public/surat_pengantar');

        // 3. Simpan Data ke Database
        MagangApplicants::create([
            'nama_lengkap' => $request->nama_lengkap,
            'asal_institusi' => $request->asal_institusi,
            'program_studi' => $request->program_studi,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'pilihan_divisi' => $request->pilihan_divisi,
            'surat_pengantar_path' => $path,
        ]);

        // Opsional: Kirim Notifikasi Email ke Admin di sini

        // 4. Redirect dengan pesan sukses
        return redirect('/daftar')->with('success', 'Pendaftaran magang berhasil diajukan! Admin akan segera menghubungi Anda.');
    }

    /**
     * Proses Kirim Pesan Kontak (POST)
     */
    public function sendKontak(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'pesan' => 'required|string|max:500',
        ]);

        // 2. Logika Pengiriman Email
        // Di lingkungan nyata, Anda akan menggunakan Mail::to('admin@pnkla.go.id')->send(...)

        // Contoh: Simpan ke log atau kirim email langsung (perlu setup mail di .env)
        // Mail::send(new KontakMail($request->all())); 

        // Karena ini hanya kerangka, kita asumsikan sukses

        return redirect('/kontak')->with('success', 'Pesan Anda berhasil terkirim. Kami akan merespons secepatnya!');
    }
}
