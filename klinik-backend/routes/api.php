<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\Api\DokterController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\PendaftaranController;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Jadwal;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Endpoint khusus untuk Dashboard Statistik
    Route::get('/dashboard', function () {
        return response()->json([
            'success' => true,
            'data' => [
                'total_pasien' => Pasien::count(),
                'total_dokter' => Dokter::count(),
                'total_jadwal' => Jadwal::count(),
            ]
        ]);
    });

    // Endpoint CRUD Master Data & Transaksi
    Route::apiResource('pasiens', PasienController::class);
    Route::apiResource('dokters', DokterController::class);
    Route::apiResource('jadwals', JadwalController::class);
    Route::apiResource('pendaftarans', PendaftaranController::class);
});