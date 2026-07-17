<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        return response()->json(['success' => true, 'data' => Dokter::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'spesialis' => 'required|string',
            'no_hp' => 'required|string',
        ]);
        $dokter = Dokter::create($request->all());
        return response()->json(['success' => true, 'data' => $dokter], 201);
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::find($id);
        $dokter->update($request->all());
        return response()->json(['success' => true, 'data' => $dokter]);
    }

    public function destroy($id)
    {
        Dokter::destroy($id);
        return response()->json(['success' => true, 'message' => 'Dihapus']);
    }
}