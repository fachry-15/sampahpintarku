<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            Log::info('Google User Data:', (array) $googleUser);

            // Pecah nama menjadi first name dan last name
            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $googleUser->user['given_name'] ?? $nameParts[0] ?? null;
            $lastName = $googleUser->user['family_name'] ?? $nameParts[1] ?? null;

            // Check if the user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'first_name'   => $firstName,
                    'last_name'    => $lastName,
                    'name'         => $fullName, // Simpan full name di kolom name
                    'email'        => $googleUser->getEmail(),
                    'password'     => Hash::make(uniqid()), // Password random
                    'provider'     => 'google',
                    'provider_id'  => $googleUser->id,
                ]);
            }

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Terima kasih, akun Anda berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Mohon maaf, Akun anda belum berhasil dibuat');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
