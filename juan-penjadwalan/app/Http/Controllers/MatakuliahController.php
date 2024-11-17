<?php

namespace App\Http\Controllers;

use App\Http\Requests\HariStoreRequest;
use App\Http\Requests\MatakuliahStoreRequest;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matakuliah = Matakuliah::all();
        return response()->json([
            'results' => $matakuliah
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatakuliahStoreRequest $request)
    {
        try {
            Matakuliah::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'sks' => $request->sks,
                'semester' => $request->semester,
            ]);
            

            // Return Json Response
            return response()->json([
                'message' => "Data matakuliah berhasil dibuat."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Gagal membuat data matakuliah. " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
            return response()->json([
                'message' => 'Data matakuliah tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'matakuliah' => $matakuliah
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatakuliahStoreRequest $request, $id)
    {
        try {
            $matakuliah = Matakuliah::find($id);
            if (!$matakuliah) {
                return response()->json([
                    'message' => 'Data matakuliah tidak ditemukan.'
                ], 404);
            }

            // Perbarui data matakuliah
            $matakuliah->kode = $request->kode;
            $matakuliah->nama = $request->nama;
            $matakuliah->sks = $request->sks;
            $matakuliah->semester = $request->semester;

            // Simpan perubahan
            $matakuliah->save();

            // Return Json Response
            return response()->json([
                'message' => "Data matakuliah berhasil diperbarui."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Gagal memperbarui data matakuliah. " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $matakuliah = Matakuliah::find($id);
            if (!$matakuliah) {
                return response()->json([
                    'message' => 'Data matakuliah tidak ditemukan.'
                ], 404);
            }

            $matakuliah->delete();

            return response()->json([
                'message' => "Data matakuliah berhasil dihapus."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Gagal menghapus data matakuliah. " . $e->getMessage()
            ], 500);
        }
    }
}
