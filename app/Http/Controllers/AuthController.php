<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Menampilkan form login tunggal.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Menggunakan view login yang sama
    }

    /**
     * Memproses permintaan login tunggal dan mengalihkan berdasarkan role.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // --- LOGIKA PENGALIHAN BERDASARKAN ROLE ---
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Default: Redirect ke Dashboard Pengguna (user)
            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan form registrasi tunggal (default role: user).
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Memproses permintaan registrasi (Role default: user).
     */
    public function register(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Buat user baru dengan role default 'user'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Set role default saat registrasi
        ]);

        // 3. Login user secara otomatis
        Auth::login($user);

        // 4. Redirect ke dashboard umum
        return redirect()->route('user.dashboard')->with('success', 'Akun berhasil dibuat dan Anda telah login!');
    }


    /**
     * Proses logout tunggal.
     */
    public function logout(Request $request)
    {
        // Tentukan redirect berdasarkan rute yang memanggil logout
        $redirectTo = str_contains($request->url(), '/admin') ? route('login') : route('login');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect kembali ke halaman login
        return redirect($redirectTo)->with('status', 'Anda telah berhasil logout.');
    }

    /**
     * Menampilkan form untuk mengubah profil dan password.
     */
    public function showProfileForm()
    {
        // Pastikan pengguna yang sedang login adalah pengguna biasa (user)
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak.');
        }

        return view('user.profile'); // Perlu membuat view ini
    }

    /**
     * Memproses permintaan update profil pengguna (nama, email, dan password).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Pastikan email unik, kecuali untuk email pengguna saat ini
                Rule::unique('users')->ignore($user->id),
            ],
            // Validasi Password saat ini hanya dilakukan jika input 'password' diisi
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        $request->validate($validationRules, [
            'email.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'current_password.current_password' => 'Password saat ini tidak cocok.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'current_password.required_with' => 'Password saat ini wajib diisi jika ingin mengganti password baru.'
        ]);

        // 2. Update Nama dan Email
        $user->name = $request->name;
        // Hanya update email jika ada perubahan
        if ($user->email !== $request->email) {
            $user->email = $request->email;
        }

        // 3. Update Password (Jika ada input password baru dan sudah divalidasi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}
