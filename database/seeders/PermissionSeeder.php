<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',

            // Properties
            'property_view',
            'property_create',
            'property_edit',
            'property_delete',

            // Roles
            'role_view',
            'role_assign',

            // Dashboard
            'dashboard_access',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
