<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('main_controls')->insert([
            'debit_max_organik' => 100,
            'debit_max_anorganik' => 200,
            'delay_pengambilan' => 30,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
