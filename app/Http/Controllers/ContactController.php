<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string',
        ]);

        // Create a new contact record
        $contact = new contact();
        $contact->name = $validatedData['name'];
        $contact->email = $validatedData['email'];
        $contact->phone = $validatedData['phone'];
        $contact->message = $validatedData['message'];
        $contact->save();

        try {
            // Redirect or return a response with notify
            return redirect()->back()->with('notify', [
                'type' => 'success',
                'message' => 'Pesan Anda telah berhasil dikirim.',
            ]);
        } catch (\Exception $e) {
            Log::error('Contact submission error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('notify', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contact $contact)
    {
        //
    }
}
