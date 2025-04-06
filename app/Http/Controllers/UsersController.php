<?php

namespace App\Http\Controllers;

use App\Models\InformationsUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function activation($id)
    {
        $users = User::find($id);
        return view('activation', compact('users'));
    }

    public function updateActivation(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'alamat' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'district' => 'nullable|string',
            'village' => 'nullable|string',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->status = $request->status;
            $user->save();

            InformationsUser::create([
                'user_id' => $user->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'address' => $request->alamat,
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district,
                'village' => $request->village,
            ]);

            return redirect()->route('users.index')->with('success', 'User activation updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating user activation: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating user activation. Please try again later.']);
        }
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
    public function edit($id)
    {
        $users = User::with('informationsUser')->find($id);
        return view('editusers', compact('users'));
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
