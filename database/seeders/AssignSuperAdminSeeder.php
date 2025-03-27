<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari user dengan ID 1
        $user = User::find(1);

        if ($user) {
            // Pastikan role Super Admin sudah ada
            $role = Role::firstOrCreate(['name' => 'superadmin']);

            // Berikan role Super Admin ke user ID 1
            $user->assignRole($role);

            // Update nilai status menjadi 1 di tabel users
            $user->update(['status' => 1]);

            $this->command->info('Role Super Admin berhasil diberikan ke User ID 1 dan status diperbarui menjadi 1');
        } else {
            $this->command->warn('User dengan ID 1 tidak ditemukan.');
        }
    }
}
