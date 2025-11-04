<?php

namespace App\Http\Controllers;

use App\Models\MagangApplicants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;    // [BARU] Impor Mail Facade
use App\Mail\ApplicationStatusMail;     // [BARU] Impor Mailable Class
use Illuminate\Support\Facades\Auth;    // Diperlukan untuk middleware/Auth::user()
use Carbon\Carbon;

class AdminController extends Controller
{
    // Konstanta Cooldown
    const COOLDOWN_INCOMPLETE = 7;
    const COOLDOWN_QUOTA = 30;
    const COOLDOWN_VIOLATION = 90;

    // Mapping Alasan ke Cooldown Days
    const REJECTION_OPTIONS = [
        self::COOLDOWN_INCOMPLETE => 'Administrasi Kurang / Tidak Lengkap (7 Hari)',
        self::COOLDOWN_QUOTA => 'Tidak Sesuai Kebutuhan / Kuota Penuh (30 Hari)',
        self::COOLDOWN_VIOLATION => 'Pelanggaran Aturan / Data Tidak Valid (90 Hari)',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan Dashboard Admin (Daftar Pelamar) dengan Statistik Real-time.
     */
    public function dashboard()
    {
        // Mengambil data pelamar dengan pagination
        $applicants = MagangApplicants::orderBy('created_at', 'desc')->paginate(10);

        // Statistik Real-time
        $totalApplicants = MagangApplicants::count();
        $totalPending = MagangApplicants::where('status', 'pending')->count();
        $totalAccepted = MagangApplicants::where('status', 'accepted')->count();
        $totalRejected = MagangApplicants::where('status', 'rejected')->count();

        $rejectionOptions = self::REJECTION_OPTIONS;

        return view('admin.dashboard', compact('applicants', 'rejectionOptions', 'totalApplicants', 'totalPending', 'totalAccepted', 'totalRejected'));
    }

    /**
     * Memproses pengajuan pelamar (Accept/Reject) dengan logika SK dan Cooldown.
     */
    public function processApplicant(Request $request, $id)
    {
        $applicant = MagangApplicants::findOrFail($id);

        // 1. Validasi Input Dasar
        $request->validate([
            'status' => 'required|in:accepted,rejected',
            'alasan_admin' => 'nullable|string|max:500',

            // Validasi Kondisional untuk REJECT
            'cooldown_days' => 'nullable|required_if:status,rejected|integer|in:' . implode(',', array_keys(self::REJECTION_OPTIONS)),

            // Validasi Kondisional untuk ACCEPT
            'surat_keputusan' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $applicant->tanggal_keputusan = Carbon::now();
        $applicant->status = $request->status;
        $emailStatus = $request->status; // 'accepted' atau 'rejected' untuk Mailable

        if ($request->status === 'rejected') {
            // Logika Reject (dengan Cooldown)
            $cooldownDays = (int)$request->cooldown_days;
            // PREFIX alasan dengan tag cooldown untuk dibaca AppController
            $cooldownTag = "[COOLDOWN:{$cooldownDays}]";
            $applicant->alasan_admin = $cooldownTag . ' ' . $request->alasan_admin;
            $applicant->surat_keputusan_path = null; // Pastikan path SK dihapus jika ditolak

        } elseif ($request->status === 'accepted') {
            // Logika Accept (dengan Upload SK Wajib)
            if (!$request->hasFile('surat_keputusan')) {
                return redirect()->back()->with('error', 'File Surat Keputusan (PDF) wajib diunggah untuk status DITERIMA.');
            }

            // Upload File PDF Keputusan
            $suratKeputusanPath = $request->file('surat_keputusan')->store('public/surat_keputusan_admin');

            $applicant->surat_keputusan_path = $suratKeputusanPath;
            $applicant->alasan_admin = $request->alasan_admin ?? 'Permohonan Magang Diterima.';
        }

        $applicant->save(); // Simpan perubahan status ke database

        // 2. [NEW] Kirim Email Pemberitahuan
        $emailStatus = $request->status;
        try {
            // Menggunakan email pendaftar ($applicant->email) sebagai tujuan
            Mail::to($applicant->email)->send(new ApplicationStatusMail($applicant, $emailStatus));

            $statusIndo = ($emailStatus === 'accepted') ? 'Diterima' : 'Ditolak';
            $successMessage = "Status pelamar berhasil diperbarui menjadi **{$statusIndo}**. Email pemberitahuan **telah dikirim**.";
        } catch (\Exception $e) {
            $statusIndo = ($emailStatus === 'accepted') ? 'Diterima' : 'Ditolak';
            // Pesan error lebih ramah dan tidak menyebabkan error 500 jika email gagal
            $successMessage = "Status pelamar berhasil diperbarui menjadi **{$statusIndo}**, namun pengiriman email **gagal**. Pastikan konfigurasi MAIL di .env sudah benar. ({$e->getMessage()})";
        }

        return redirect()->route('admin.dashboard')->with('success', $successMessage);
    }

    /**
     * Fungsi untuk mengunduh file
     */
    public function downloadFile($fileType, $id)
    {
        $applicant = MagangApplicants::findOrFail($id);

        if ($fileType === 'pengantar') {
            $path = $applicant->surat_pengantar_path;
            $fileName = 'Surat_Pengantar_' . $applicant->nama_lengkap . '.pdf';
        } elseif ($fileType === 'keputusan' && $applicant->surat_keputusan_path) {
            $path = $applicant->surat_keputusan_path;
            $fileName = 'SK_Penerimaan_' . $applicant->nama_lengkap . '.pdf';
        } else {
            abort(404, 'File tidak ditemukan.');
        }

        $path = str_replace('public/', '', $path);

        if (Storage::disk('public')->exists($path)) {
            // Menggunakan Storage::download untuk memastikan file didownload dengan nama yang benar
            return Storage::disk('public')->download($path, $fileName);
        }

        abort(404, 'File tidak ditemukan di server.');
    }

    public function deleteApplicant($id)
    {
        $applicant = MagangApplicants::findOrFail($id);
        $applicantName = $applicant->nama_lengkap;

        // 1. Hapus File dari Storage
        // Hapus Surat Pengantar
        if ($applicant->surat_pengantar_path && Storage::disk('public')->exists(str_replace('public/', '', $applicant->surat_pengantar_path))) {
            Storage::delete($applicant->surat_pengantar_path);
        }

        // Hapus Surat Keputusan (jika ada)
        if ($applicant->surat_keputusan_path && Storage::disk('public')->exists(str_replace('public/', '', $applicant->surat_keputusan_path))) {
            Storage::delete($applicant->surat_keputusan_path);
        }

        // 2. Hapus Record dari Database
        $applicant->delete();

        return redirect()->route('admin.dashboard')->with('success', "Lamaran dari **{$applicantName}** berhasil dihapus. Pelamar dapat mengajukan lamaran baru.");
    }
}
