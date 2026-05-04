<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing: mendecrypt password dengan algo Bcrypt / Argon
        ]);

        // redirect()->route('login') memanggil berdasarkan nama route bukan url
        return redirect()->route('login')->with('success', 'Registrasi Berhasil! Silahkan Login.');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) { // 1.Cek email dan password ke DB
            $request->session()->regenerate(); // 2. Perbarui ID Session

            return redirect()->intended('/'); // 3. Redirect ke tujuan awal
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email'); // jika error, kembali ke form dengan email yg sudah terisi (gunakan fungsi old() pada view)
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout(); // 1. Hapus info login dari aplikasi
        $request->session()->invalidate(); // 2. Hapus semua data di session saat ini
        $request->session()->regenerateToken(); // 3. Buat token CSRF baru

        return redirect('/login');
    }
}
