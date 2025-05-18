<?php

namespace App\Http\Controllers;

use App\Models\jadwal_pengambilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SampahController extends Controller
{
    public function prediksiPengambilanSampah()
    {
        // Full path ke python.exe Laragon—sesuaikan versi dan lokasi Anda
        $python = 'python';
        $script = base_path('ann.py');

        // Non-aktifkan hash randomization di environment, tanpa menggunakan -X flag
        $process = new Process([
            $python,
            $script
        ]);

        // Set environment variable untuk nonaktifkan hash randomization
        $process->setEnv(['PYTHONHASHSEED' => '0']);

        // Batasi timeout jadi 15 detik
        $process->setTimeout(15);

        // Jalankan dari project root
        $process->setWorkingDirectory(base_path());

        try {
            $process->mustRun();
        } catch (ProcessFailedException $e) {
            Log::error('Python process failed: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal menjalankan skrip Python'], 500);
        }

        // Ambil stdout saja
        $outputRaw = $process->getOutput();

        // Decode JSON
        $predictions = json_decode($outputRaw, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('JSON Decode Error: ' . json_last_error_msg());
            Log::error('Raw output: ' . $outputRaw);
            return response()->json(['error' => 'Hasil dari Python tidak valid JSON'], 500);
        }

        if (!is_array($predictions) || empty($predictions)) {
            Log::warning('Prediksi kosong atau format salah', ['data' => $predictions]);
            return response()->json(['error' => 'Prediksi kosong atau format salah'], 500);
        }

        // Hitung jadwal pengambilan
        $schedule_time = $this->tentukanJadwalPengambilan($predictions);

        // Simpan ke database
        jadwal_pengambilan::create([
            'waktu_pengambilan' => now(),
            'schedule_time'     => $schedule_time,
            'predictions'       => json_encode($predictions),
        ]);

        return response()->json([
            'message'       => 'Prediksi berhasil',
            'schedule_time' => $schedule_time,
            'predictions'   => $predictions,
        ]);
    }

    private function tentukanJadwalPengambilan(array $predictions)
    {
        $values = array_column($predictions, 'prediction');
        $avg = array_sum($values) / count($values);

        return $avg > 50
            ? '07:00:00'
            : now()->format('H:i:s');
    }
}
