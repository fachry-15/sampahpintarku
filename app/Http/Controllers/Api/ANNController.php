<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\history;
use App\Models\jadwal_pengambilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ANNController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = history::oldest()->take(83)->get();
        return new ApiResource(
            true,
            'Data Histories',
            $histories
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'waktu_pengambilan' => 'required|date',
            ]);
            jadwal_pengambilan::create([
                'waktu_pengambilan' => $request->waktu_pengambilan,
            ]);

            // Return success response
            return response()->json([
                'message' => 'Data Berhasil Masuk.',
                'data' => $request->all()
            ], 201);
        } catch (Exception $e) {
            Log::error('Error saat pelaporan: ' . $e->getMessage());
            return response()->json([
                'message' => 'Mohon maaf Pelaporan Belum Berhasil',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $histories = history::all();
        return new ApiResource(
            true,
            'Data Histories',
            $histories
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
