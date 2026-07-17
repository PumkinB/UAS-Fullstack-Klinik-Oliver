<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien; // Import model Pasien
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // 1. READ (Tampilkan semua data pasien & Fitur Pencarian)
    public function index(Request $request)
    {
        // Mengakomodasi fitur pencarian berdasarkan nama jika ada input 'keyword'
        $keyword = $request->query('keyword');
        if ($keyword) {
            $pasien = Pasien::where('nama', 'like', "%" . $keyword . "%")->get();
        } else {
            $pasien = Pasien::all();
        }

        return response()->json([
            'success' => true,
            'message' => 'Daftar data pasien',
            'data' => $pasien
        ], 200);
    }

    // 2. CREATE (Simpan data pasien baru)
    public function store(Request $request)
    {
        // Validasi input dari frontend
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        $pasien = Pasien::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil ditambahkan',
            'data' => $pasien
        ], 201);
    }

    // 3. SHOW (Tampilkan detail satu pasien)
    public function show($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json(['success' => true, 'data' => $pasien], 200);
    }

    // 4. UPDATE (Ubah data pasien)
    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $pasien->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil diubah',
            'data' => $pasien
        ], 200);
    }

    // 5. DELETE (Hapus data pasien)
    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $pasien->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil dihapus'
        ], 200);
    }
}