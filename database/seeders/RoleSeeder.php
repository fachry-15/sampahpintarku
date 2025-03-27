<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Role
        $superadmin = Role::create(['name' => 'superadmin']);
        $petugas = Role::create(['name' => 'petugas_sampah']);
        $warga = Role::create(['name' => 'warga']);
    }
}
