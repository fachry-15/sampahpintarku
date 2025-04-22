<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\history;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = history::latest()->take(3)->get();
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
        /// Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'debit_organik' => 'required|integer',
            'debit_anorganik' => 'required|integer',
        ]);

        try {
            history::create([
                'user_id' => $request->input('user_id'),
                'debit_organik' => $request->input('debit_organik'),
                'debit_anorganik' => $request->input('debit_anorganik'),
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
    public function show($id)
    {
        $histories = history::where('user_id', $id)->latest()->first();
        if ($histories) {
            return new ApiResource(
                true,
                'Data Histories',
                $histories
            );
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
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
