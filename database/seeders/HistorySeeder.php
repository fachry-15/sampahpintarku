<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistorySeeder extends Seeder
{
    public function run(): void
    {
        // Awal dari jam 00:00
        $startDate = Carbon::create(2025, 2, 3, 0, 0, 0, 'Asia/Jakarta');
        // Batas maksimal 22 April jam 00:00
        $endDate = Carbon::create(2025, 4, 22, 0, 0, 0, 'Asia/Jakarta');

        $debitOrganik = rand(5, 10);
        $debitAnorganik = rand(5, 10);
        $penuhCounter = 0;
        $durasiPenuh = rand(2, 4); // 2-4 hari penuh

        while ($startDate <= $endDate) {
            // Hitung total debit
            $total = $debitOrganik + $debitAnorganik;

            // Jika sudah penuh (di atas 70%), mulai reset
            if ($total >= 70) {
                $penuhCounter++;
            }

            if ($penuhCounter >= $durasiPenuh) {
                // Reset ke debit kecil (5-10%)
                $debitOrganik = rand(5, 10);
                $debitAnorganik = rand(5, 10);
                $penuhCounter = 0;
                $durasiPenuh = rand(2, 4);
            } else {
                // Tambah debit secara bertahap
                $debitOrganik += rand(5, 10);
                $debitAnorganik += rand(5, 10);
            }

            // Normalisasi jika lebih dari 100%
            $total = $debitOrganik + $debitAnorganik;
            if ($total > 100) {
                $scale = 100 / $total;
                $debitOrganik = (int) round($debitOrganik * $scale);
                $debitAnorganik = 100 - $debitOrganik;
            }

            DB::table('histories')->insert([
                'user_id' => 1,
                'debit_organik' => $debitOrganik,
                'debit_anorganik' => $debitAnorganik,
                'created_at' => $startDate->toDateTimeString(), // jam 00:00
                'updated_at' => $startDate->toDateTimeString(),
            ]);

            $startDate->addDay(); // lanjut ke hari berikutnya
        }
    }
}
