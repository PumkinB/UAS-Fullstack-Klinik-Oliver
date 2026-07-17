<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Wajib di-import agar bisa baca tabel users
use Illuminate\Support\Facades\Hash; // Wajib di-import untuk cek password

class AuthController extends Controller
{
    // Semua logika harus dibungkus dalam sebuah function, contohnya function login ini
    public function login(Request $request)
    {
        // 1. Validasi input (memastikan frontend mengirim email dan password)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cari data user di database berdasarkan email yang dikirim
        $user = User::where('email', $request->email)->first();

        // 3. Cek apakah usernya ada dan passwordnya cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah'
            ], 401); // 401 adalah status code Unauthorized
        }

        // 4. Jika pengecekan lolos, baru kita buat tokennya
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Kembalikan token ke frontend
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    // Nanti kamu bisa tambahkan function logout() di bawah sini
    public function logout(Request $request)
    {
        // Menghapus token yang sedang aktif
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}