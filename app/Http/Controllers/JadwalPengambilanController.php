<?php

namespace App\Http\Controllers;

use App\Models\jadwal_pengambilan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JadwalPengambilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal_pengambilans = jadwal_pengambilan::all();
        return view('trash', compact('jadwal_pengambilans'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(jadwal_pengambilan $jadwal_pengambilan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jadwal_pengambilan $jadwal_pengambilan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $jadwal_pengambilan = jadwal_pengambilan::findOrFail($id);
            $jadwal_pengambilan->update(['status' => 1]);
            return redirect()->route('sampah.index')->with('success', 'Status updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating jadwal_pengambilan: ' . $e->getMessage());
            return redirect()->route('sampah.index')->with('error', 'Failed to update status.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jadwal_pengambilan $jadwal_pengambilan)
    {
        //
    }
}
