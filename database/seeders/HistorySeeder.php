<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistorySeeder extends Seeder
{
    public function run(): void
    {
        $startDate = Carbon::create(2025, 1, 20, 0, 0, 0, 'Asia/Jakarta');
        $endDate = Carbon::create(2025, 5, 1, 0, 0, 0, 'Asia/Jakarta');

        while ($startDate <= $endDate) {
            // Reset ke debit kecil saat baru
            $debitOrganik = rand(5, 15);
            $debitAnorganik = rand(5, 15);

            // Tentukan durasi menuju penuh
            $daysToFull = $this->chooseDays(); // 3-5 hari
            $targetOrganik = rand(80, 87);
            $targetAnorganik = rand(80, 87);
            $whichOne = rand(1, 3); // 1: organik saja, 2: anorganik saja, 3: keduanya

            // Hitung penambahan per hari
            $increaseOrganik = $increaseAnorganik = 0;

            if ($whichOne == 1 || $whichOne == 3) {
                $increaseOrganik = max(3, intval(($targetOrganik - $debitOrganik) / $daysToFull));
            }
            if ($whichOne == 2 || $whichOne == 3) {
                $increaseAnorganik = max(3, intval(($targetAnorganik - $debitAnorganik) / $daysToFull));
            }

            for ($i = 1; $i <= $daysToFull; $i++) {
                if ($i < $daysToFull) {
                    $debitOrganik += ($whichOne == 1 || $whichOne == 3) ? rand($increaseOrganik - 2, $increaseOrganik + 2) : rand(1, 3);
                    $debitAnorganik += ($whichOne == 2 || $whichOne == 3) ? rand($increaseAnorganik - 2, $increaseAnorganik + 2) : rand(1, 3);

                    // Batasi maksimal 75% sebelum hari penuh
                    $debitOrganik = min($debitOrganik, 75);
                    $debitAnorganik = min($debitAnorganik, 75);
                } else {
                    // Hari ke-N (hari penuh)
                    if ($whichOne == 1) {
                        $debitOrganik = $targetOrganik;
                    } elseif ($whichOne == 2) {
                        $debitAnorganik = $targetAnorganik;
                    } else {
                        $debitOrganik = $targetOrganik;
                        $debitAnorganik = $targetAnorganik;
                    }
                }

                DB::table('histories')->insert([
                    'user_id' => 1,
                    'debit_organik' => $debitOrganik,
                    'debit_anorganik' => $debitAnorganik,
                    'created_at' => $startDate->toDateTimeString(),
                    'updated_at' => $startDate->toDateTimeString(),
                ]);

                $startDate->addDay();
            }

            // Setelah penuh, RESET KEDUANYA ke kecil
            $debitOrganik = rand(5, 15);
            $debitAnorganik = rand(5, 15);

            DB::table('histories')->insert([
                'user_id' => 1,
                'debit_organik' => $debitOrganik,
                'debit_anorganik' => $debitAnorganik,
                'created_at' => $startDate->toDateTimeString(),
                'updated_at' => $startDate->toDateTimeString(),
            ]);

            $startDate->addDay();
        }
    }

    private function chooseDays(): int
    {
        $rand = rand(1, 10);
        if ($rand <= 6) {
            return 3; // 60% kemungkinan 3 hari
        } elseif ($rand <= 9) {
            return 4; // 30% kemungkinan 4 hari
        } else {
            return 5; // 10% kemungkinan 5 hari
        }
    }
}
