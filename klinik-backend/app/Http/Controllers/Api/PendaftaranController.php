<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        // Fitur Riwayat Pemeriksaan: Mengambil pendaftaran lengkap dengan pasien dan dokter
        $pendaftaran = Pendaftaran::with(['pasien', 'jadwal.dokter'])->orderBy('tanggal_periksa', 'desc')->get();
        return response()->json(['success' => true, 'data' => $pendaftaran]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'tanggal_periksa' => 'required|date',
            'keluhan' => 'required|string',
        ]);
        
        $pendaftaran = Pendaftaran::create([
            'pasien_id' => $request->pasien_id,
            'jadwal_id' => $request->jadwal_id,
            'tanggal_periksa' => $request->tanggal_periksa,
            'keluhan' => $request->keluhan,
            'status' => 'Antre'
        ]);
        return response()->json(['success' => true, 'data' => $pendaftaran], 201);
    }

    public function update(Request $request, $id)
    {
        // Biasanya digunakan dokter untuk mengisi hasil diagnosis dan mengubah status menjadi Selesai
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->update($request->all());
        return response()->json(['success' => true, 'data' => $pendaftaran]);
    }
}