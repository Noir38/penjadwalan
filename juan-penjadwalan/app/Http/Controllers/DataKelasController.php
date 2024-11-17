<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataKelasStoreRequest;
use App\Models\DataKelas;
use Illuminate\Http\Request;

class DataKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataKelas = DataKelas::all();
        return response()->json([
            'results' => $dataKelas
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataKelasStoreRequest $request)
    {
        try {
           
           
            DataKelas::create([
                'kode_ruang' => $request->kode_ruang, 
                'kapasitas_ruang' => $request->kapasitas_ruang, 
                
            ]);
            $data = $request->validated();

            // Return Json Response
            return response()->json([
                'message' => "Kelas successfully created."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Failed to create Kelas. " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataKelas = DataKelas::find($id);
        if (!$dataKelas) {
            return response()->json([
                'message' => 'Data kelas tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'dataKelas' => $dataKelas
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataKelasStoreRequest $request, $id)
    {
        try {
            // Temukan Dosen berdasarkan ID
            $dataKelas = DataKelas::find($id);
            if (!$dataKelas) {
                return response()->json([
                    'message' => 'dataKelas Not Found.'
                ], 404);
            }

            // Perbarui data nama dan email dataKelas
            $dataKelas->kode_ruang = $request->kode_ruang;
            $dataKelas->kapasitas_ruang = $request->kapasitas_ruang;
          

            // Simpan perubahan
            $dataKelas->save();

            // Return Json Response
            return response()->json([
                'message' => "Dosen successfully updated."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Failed to update Dosen. " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $dataKelas = DataKelas::find($id);
            if (!$dataKelas) {
                return response()->json([
                    'message' => 'Data kelas tidak ditemukan.'
                ], 404);
            }

            $dataKelas->delete();

            return response()->json([
                'message' => "Data kelas berhasil dihapus."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Gagal menghapus data kelas. " . $e->getMessage()
            ], 500);
        }
    }
}

