<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataAngkatanStoreRequest;
use App\Models\DataAngkatan;
use Illuminate\Http\Request;

class DataAngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataAngkatan = DataAngkatan::all();
        return response()->json([
            'results' => $dataAngkatan
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataAngkatanStoreRequest $request)
    {
        try {
            DataAngkatan::create([
                'jurusan' => $request->jurusan,
                // Sisipkan nilai untuk kolom-kolom lainnya jika ada
            ]);
    
            // Return Json Response
            return response()->json([
                'message' => "Data angkatan berhasil dibuat."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Gagal membuat data angkatan. " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataAngkatan = DataAngkatan::find($id);
        if (!$dataAngkatan) {
            return response()->json([
                'message' => 'Data angkatan tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'dataAngkatan' => $dataAngkatan
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataAngkatanStoreRequest $request, $id)
    {
        try {
            $dataAngkatan = DataAngkatan::find($id);
            if (!$dataAngkatan) {
                return response()->json([
                    'message' => 'Data angkatan tidak ditemukan.'
                ], 404);
            }

            // Perbarui data jurusan
            $dataAngkatan->jurusan = $request->jurusan;

            // Simpan perubahan
            $dataAngkatan->save();

            // Return Json Response
            return response()->json([
                'message' => "Data angkatan berhasil diperbarui."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Gagal memperbarui data angkatan. " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $dataAngkatan = DataAngkatan::find($id);
            if (!$dataAngkatan) {
                return response()->json([
                    'message' => 'Data angkatan tidak ditemukan.'
                ], 404);
            }

            $dataAngkatan->delete();

            return response()->json([
                'message' => "Data angkatan berhasil dihapus."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Gagal menghapus data angkatan. " . $e->getMessage()
            ], 500);
        }
    }
}
