<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AssignAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Assign admin role to the main admin user
        $admin = User::where('email', 'admin@admin.com')->first();

        if ($admin) {
            $admin->assignRole('admin');
        }
    }
}
