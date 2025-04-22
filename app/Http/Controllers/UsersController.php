<?php

namespace App\Http\Controllers;

use App\Models\InformationsUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Mckenziearts\Notify\LaravelNotify;

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

            return redirect()->route('user.index')->with('notify', [
                'type' => 'success',
                'message' => 'Terima kasih, aktivasi user berhasil diaktivasi.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating user activation: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('notify', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui aktivasi user.',
            ]);
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
        $roles = Role::all();
        $users = User::with('informationsUser')->find($id);
        return view('editusers', compact('users', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
            'alamat' => 'required|string',
            'role' => 'nullable|string',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->status = $request->status;
            $user->save();

            $informationUser = InformationsUser::where('user_id', $id)->first();
            if ($informationUser) {
                $informationUser->address = $request->alamat;
                $informationUser->save();
            } else {
                InformationsUser::create([
                    'user_id' => $id,
                    'address' => $request->alamat,
                ]);
            }

            if ($request->role) {
                $user->syncRoles([$request->role]);
            }

            return redirect()->route('user.index')->with('notify', [
                'type' => 'success',
                'message' => 'Terima kasih, data user berhasil diperbarui.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating user information: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('notify', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data user.',
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
