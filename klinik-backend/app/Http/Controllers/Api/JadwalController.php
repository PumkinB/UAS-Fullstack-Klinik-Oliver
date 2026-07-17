<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        // Mengambil jadwal beserta relasi nama dokternya
        $jadwal = Jadwal::with('dokter')->get();
        return response()->json(['success' => true, 'data' => $jadwal]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);
        $jadwal = Jadwal::create($request->all());
        return response()->json(['success' => true, 'data' => $jadwal], 201);
    }
}