<?php

namespace App\Http\Controllers;

use App\Http\Requests\DailyscheduleStoreRequest;
use App\Models\Dailyschedule;
use Illuminate\Http\Request;

class DailyscheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyschedule = Dailyschedule::all();
        return response()->json([
            'results' => $dailyschedule
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DailyscheduleStoreRequest $request)
    {
        try {
            // Ambil user_id dari request atau sesi login
            $user_id = $request->user_id; // Pastikan user_id dikirimkan dalam request

            // Simpan data schedule dengan user_id
            Dailyschedule::create([
                'user_id' => $user_id,        // Menambahkan user_id ke data yang disimpan
                'kode' => $request->kode,
                'matakuliah' => $request->matakuliah,
                'sks' => $request->sks,
                'nama_kelas' => $request->nama_kelas,
                'hari' => $request->hari,
                'jam' => $request->jam,
                'ruang' => $request->ruang,
                'pengampu1' => $request->pengampu1,
                'pengampu2' => $request->pengampu2,
                // Sisipkan nilai untuk kolom-kolom lainnya jika ada
            ]);

            // Return Json Response
            return response()->json([
                'message' => "Data angkatan berhasil dibuat."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response jika terjadi error
            return response()->json([
                'message' => "Gagal membuat data daily. " . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
     public function show($id)
    {
        $dailyschedule = Dailyschedule::find($id);
        if (!$dailyschedule) {
            return response()->json([
                'message' => 'Data daily tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'dailyschedule' => $dailyschedule
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DailyscheduleStoreRequest $request, $id)
    {
        try {
            $dailyschedule = Dailyschedule::find($id);
            if (!$dailyschedule) {
                return response()->json([
                    'message' => 'Data daily tidak ditemukan.'
                ], 404);
            }

            // Perbarui data jurusan
            $dailyschedule->kode = $request->kode;
            $dailyschedule->matakuliah = $request->matakuliah;
            $dailyschedule->sks = $request->sks;
            $dailyschedule->nama_kelas = $request->nama_kelas;
            $dailyschedule->hari = $request->hari;
            $dailyschedule->jam = $request->jam;
            $dailyschedule->ruang = $request->ruang;
            $dailyschedule->pengampu1 = $request->pengampu1;
            $dailyschedule->pengampu2 = $request->pengampu2;

            // Simpan perubahan
            $dailyschedule->save();

            // Return Json Response
            return response()->json([
                'message' => "Data daily berhasil diperbarui."
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
            $dailyschedule = Dailyschedule::find($id);
            if (!$dailyschedule) {
                return response()->json([
                    'message' => 'Data angkatan tidak ditemukan.'
                ], 404);
            }

            $dailyschedule->delete();

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

 