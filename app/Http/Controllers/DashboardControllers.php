<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\jadwal_pengambilan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('informationsuser')->latest()->take(5)->get();
        $grafik = history::with('user')->where('user_id', auth()->user()->id)->latest()->take(10)->get();
        $history = history::with('user')->latest()->take(10)->get();
        $jadwal = jadwal_pengambilan::where('status', 1)->latest()->first();

        $detail = $history->where('user_id', auth()->user()->id)->last();
        return view('dashboard', compact('users', 'history', 'detail', 'grafik', 'jadwal'));
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
    public function show(string $id)
    {
        //
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
