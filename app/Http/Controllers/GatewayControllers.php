<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GatewayControllers extends Controller
{
     public function sendMessage()
    {
        // Ambil token dari file .env
        $token = env('FONNTE_TOKEN');

        // Nomor tujuan (gunakan format internasional, contoh: 6281234567890)
        $target = '6281357808863'; // <-- Ganti dengan nomor tujuan

        // Pesan yang akan dikirim
        $message = "Halo! Ini adalah pesan tes dari Laravel 11 menggunakan Fonnte. ✨";

        // Lakukan HTTP POST Request ke API Fonnte
        $response = Http::withHeaders([
            'Authorization' => $token, // <-- Auth Token
        ])->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
            'countryCode' => '62', // Optional
        ]);

        // Opsi untuk melihat response dari Fonnte
        $result = $response->json();

        // Cek jika pengiriman berhasil
        if (isset($result['status']) && $result['status'] === true) {
            // Jika berhasil
            return "Pesan WhatsApp berhasil dikirim.";
        } else {
            // Jika gagal
            // Anda bisa melihat detail error di $result
            return "Gagal mengirim pesan WhatsApp. Response: " . json_encode($result);
        }
    }
}
