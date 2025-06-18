<?php

namespace App\Http\Controllers;

use App\Models\Balasan;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BalasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $validated = $request->validate([
                'pesan_id' => 'required|exists:pesans,id',
                'balasan_isi' => 'required|string',
                'status' => 'required|in:0,1,2',
            ]);

            $data = [
                'pesan_id' => $validated['pesan_id'],
                'user_id' => Auth::id(),
                'isi' => $validated['balasan_isi'],
                'status' => $validated['status'],
            ];

            $balasan = Balasan::create($data);

            // Update status pada tabel pesan sesuai pesan_id
            Pesan::where('id', $validated['pesan_id'])
                ->update(['status' => $validated['status']]);

            return redirect()->back()->with('notify', [
                'type' => 'success',
                'message' => 'Balasan berhasil dikirim!',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim balasan: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
                'request' => $request->all(),
            ]);
            return redirect()->back()->with('notify', [
                'type' => 'danger',
                'message' => 'Terjadi kesalahan saat mengirim balasan.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Balasan $balasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Balasan $balasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Balasan $balasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Balasan $balasan)
    {
        //
    }
}
