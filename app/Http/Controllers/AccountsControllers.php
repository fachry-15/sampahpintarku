<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccountsControllers extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('editprofile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // Gunakan model User secara eksplisit
        $user = User::findOrFail($request->user()->id);

        try {
            // update basic fields
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');

            // reset email verification if email changed
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            // handle profile image upload and save to public directory
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = uniqid('profile_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('profiles'), $filename);
                $user->photo = 'profiles/' . $filename;
            }

            $user->save();

            // Kirim pesan WhatsApp jika berhasil update profil
            try {
                $token = env('FONNTE_TOKEN');
                $target = $user->phone_number; // gunakan nomor dari user
                $message = "Halo {$user->first_name}, profil Anda telah berhasil diperbarui. Jika ini adalah perubahan pertama Anda, silakan tunggu proses aktivasi dan konfirmasi dari admin melalui WhatsApp. Jangan lupa untuk selalu memantau informasi terbaru di platform Tempat Sampahku. Terima kasih dan tetap sehat!";

                $response = Http::withHeaders([
                    'Authorization' => $token,
                ])->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => '62',
                ]);

                $result = $response->json();
                if (!isset($result['status']) || $result['status'] !== true) {
                    Log::warning('Gagal mengirim WhatsApp: ' . json_encode($result));
                }
            } catch (\Exception $waEx) {
                Log::error('Gagal mengirim WhatsApp: ' . $waEx->getMessage());
            }

            return redirect()->route('profile.edit')->with('notify', [
                'type' => 'success',
                'message' => 'Profil berhasil diperbarui!',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to update profile: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'exception' => $e
            ]);
            return redirect()->back()->with('notify', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui profil. Silakan coba lagi.',
            ]);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
