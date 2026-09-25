<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $credentials['status_akun'] = 'aktif';

        if (Auth::attempt($credentials)) {
    $request->session()->regenerate();

    $user = Auth::user();

    // Membuat notifikasi awal hanya untuk user yang belum memiliki notifikasi
        if (
            $user->role === 'user' &&
            !Notification::where('user_id', $user->id_user)->exists()
        ) {

            Notification::create([
                'user_id' => $user->id_user,
                'title' => 'Selamat datang di EVChargeHub',
                'message' => 'Akun Anda berhasil masuk ke sistem EVChargeHub. Selamat menggunakan layanan kami.',
                'type' => 'system',
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $user->id_user,
                'title' => 'Tambahkan kendaraan',
                'message' => 'Silakan tambahkan kendaraan listrik Anda sebelum melakukan charging.',
                'type' => 'vehicle',
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $user->id_user,
                'title' => 'Charging Station tersedia',
                'message' => 'Anda dapat melihat lokasi charging station dan charger yang tersedia.',
                'type' => 'system',
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $user->id_user,
                'title' => 'Siap melakukan charging',
                'message' => 'Pilih charging station dan charger yang tersedia untuk memulai sesi charging.',
                'type' => 'charging',
                'is_read' => false,
            ]);
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'operator') {
            return redirect()->route('operator.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}