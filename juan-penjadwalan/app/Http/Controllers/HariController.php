<?php

namespace App\Http\Controllers;

use App\Http\Requests\HariStoreRequest;
use App\Models\Hari;
use Illuminate\Http\Request;

class HariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hari = Hari::all();
        return response()->json([
            'results' => $hari
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HariStoreRequest $request)
    {
        try {
            Hari::create([
                'hari' => $request->hari
            ]);

            // Return Json Response
            return response()->json([
                'message' => "Data hari berhasil dibuat."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Gagal membuat data hari. " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hari = Hari::find($id);
        if (!$hari) {
            return response()->json([
                'message' => 'Data hari tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'hari' => $hari
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HariStoreRequest $request, $id)
    {
        try {
            $hari = Hari::find($id);
            if (!$hari) {
                return response()->json([
                    'message' => 'Data hari tidak ditemukan.'
                ], 404);
            }

            // Perbarui data hari
            $hari->hari = $request->hari;

            // Simpan perubahan
            $hari->save();

            // Return Json Response
            return response()->json([
                'message' => "Data hari berhasil diperbarui."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Gagal memperbarui data hari. " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $hari = Hari::find($id);
            if (!$hari) {
                return response()->json([
                    'message' => 'Data hari tidak ditemukan.'
                ], 404);
            }

            $hari->delete();

            return response()->json([
                'message' => "Data hari berhasil dihapus."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Gagal menghapus data hari. " . $e->getMessage()
            ], 500);
        }
    }
}
