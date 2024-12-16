<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosenStoreRequest;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::all();
        return response()->json([
            'results' => $dosen
        ], 200);
    }

    public function store(DosenStoreRequest $request)
    {
        try {
           

            // Create Dosen
            Dosen::create([
                'nidn' => $request->nidn,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                's1' => $request->s1 ?? null, // Beri nilai null jika kosong
                's2' => $request->s2 ?? null, // Beri nilai null jika kosong
                's3' => $request->s3 ?? null, // Beri nilai null jika kosong
            ]);
            $data = $request->validated();

            // Return Json Response
            return response()->json([
                'message' => "Dosen successfully created."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Failed to create Dosen. " . $e->getMessage()
            ], 500);
        }
    }

    



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Dosen Detail 
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json([
                'message' => 'Dosen Not Found.'
            ], 404);
        }

        // Return Json Response
        return response()->json([
            'Dosen' => $dosen
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DosenStoreRequest $request, $id)
    {
        try {
            // Temukan Dosen berdasarkan ID
            $dosen = Dosen::find($id);
            if (!$dosen) {
                return response()->json([
                    'message' => 'Dosen Not Found.'
                ], 404);
            }

            // Perbarui data nama dan email Dosen
            $dosen->nidn = $request->nidn;
            $dosen->nama = $request->nama;
            $dosen->alamat = $request->alamat;
            $dosen->s1 = $request->s1 ?? null;
            $dosen->s2 = $request->s2 ?? null;
            $dosen->s3 = $request->s3 ?? null;
            $dosen->save();
            

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
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Temukan Dosen berdasarkan ID
            $dosen = Dosen::find($id);
            if (!$dosen) {
                return response()->json([
                    'message' => 'Dosen Not Found.'
                ], 404);
            }
            
            // Hapus Dosen
            $dosen->delete();
    
            // Return Json Response
            return response()->json([
                'message' => "Dosen successfully deleted."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Failed to delete Dosen. " . $e->getMessage()
            ], 500);
        }
    }
}
