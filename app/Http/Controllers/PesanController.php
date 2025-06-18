<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesan = Pesan::with(['user', 'balasan'])->get();
        $petugas = User::role('petugas_sampah')->get();
        return view('pesan', compact('pesan', 'petugas'));
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
        $request->validate([
            'judul_laporan' => 'required',
            'isi_pesan' => 'required',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal_mulai' => 'nullable|date|after_or_equal:today',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'phone_number' => ['required','regex:/^62[0-9]{9,13}$/', 'starts_with:62', 'min:12', 'max:15'],
        ]);

        try {
            $pesan = new Pesan();
            $pesan->judul = $request->judul_laporan;
            $pesan->isi = $request->isi_pesan;
            $pesan->tanggal_mulai = $request->tanggal_mulai;
            $pesan->tanggal_selesai = $request->tanggal_selesai;
            $pesan->user_id = Auth::id();
            if ($request->hasFile('lampiran')) {
                $file = $request->file('lampiran');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('lampiran'), $filename);
                $pesan->lampiran = $filename;
            }
            $pesan->save();

            // Kirim pesan WhatsApp ke nomor dari input phone_number
            try {
                $token = env('FONNTE_TOKEN');
                $target = $request->phone_number;
                $userName = Auth::user()->name ?? 'Pengguna';
                $message = "📢 *LAPORAN PESAN DARI WARGA*\n\n"
                    . "👤 Dari: {$userName}\n"
                    . "📝 Judul Laporan:\n*{$pesan->judul}*\n\n"
                    . "💬 Isi Laporan:\n{$pesan->isi}\n\n"
                    . "🌐 Untuk melihat informasi lengkap atau membalas laporan ini, silakan kunjungi pusat laporan di website TempatSampahku.\n\n"
                    . "⏳ Segera berikan tanggapan Anda agar kami dapat memberikan pelayanan terbaik.\n"
                    . "🙏 Terima kasih atas perhatian dan kerjasama Anda.";

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => $token,
                ])->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => '62',
                ]);

                $result = $response->json();
                if (!isset($result['status']) || $result['status'] !== true) {
                    Log::warning('Gagal mengirim pesan WhatsApp: ' . json_encode($result));
                }
            } catch (\Exception $e) {
                Log::error('Error saat mengirim pesan WhatsApp: ' . $e->getMessage());
            }

            return redirect()->route('pesan.index')->with('success', 'Terima kasih, sudah melaporan tunggu hingga terdapat konfirmasi dari admin');
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan pesan: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesan $pesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesan $pesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesan $pesan)
    {
        //
    }
}
