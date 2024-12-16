<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatakuliahStoreRequest;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $matakuliah = Matakuliah::all();

        return response()->json([
            'results' => $matakuliah
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatakuliahStoreRequest $request): JsonResponse
    {
        try {
            $matakuliah = Matakuliah::create($request->validated());

            return response()->json([
                'message' => 'Data matakuliah berhasil dibuat.',
                'data' => $matakuliah
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal membuat data matakuliah.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
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
    public function update(MatakuliahStoreRequest $request, int $id): JsonResponse
    {
        try {
            $matakuliah = Matakuliah::find($id);

            if (!$matakuliah) {
                return response()->json([
                    'message' => 'Data matakuliah tidak ditemukan.'
                ], 404);
            }

            $matakuliah->update($request->validated());

            return response()->json([
                'message' => 'Data matakuliah berhasil diperbarui.',
                'data' => $matakuliah
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data matakuliah.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
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
                'message' => 'Data matakuliah berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data matakuliah.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
