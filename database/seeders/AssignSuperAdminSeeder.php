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
        // IDs of users to assign the Super Admin role
        $userIds = [1, 2];

        foreach ($userIds as $id) {
            // Find user by ID
            $user = User::find($id);

            if ($user) {
                // Ensure the Super Admin role exists
                $role = Role::firstOrCreate(['name' => 'superadmin']);

                // Assign the Super Admin role to the user
                $user->assignRole($role);

                // Update the status to 1 in the users table
                $user->update(['status' => 1]);

                $this->command->info("Role Super Admin berhasil diberikan ke User ID $id dan status diperbarui menjadi 1");
            } else {
                $this->command->warn("User dengan ID $id tidak ditemukan.");
            }
        }
    }
}
