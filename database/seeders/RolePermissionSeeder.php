<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch roles
        $admin = Role::where('name', 'admin')->first();
        $owner = Role::where('name', 'owner')->first();
        $buyer = Role::where('name', 'buyer')->first();
        $agent = Role::where('name', 'agent')->first();

        // Admin gets everything
        $admin?->givePermissionTo(Permission::all());

        // Owner permissions
        $ownerPermissions = [
            'property_view',
            'property_create',
            'property_edit',
            'property_delete',
        ];
        $owner?->syncPermissions($ownerPermissions);

        // Buyer permissions
        $buyerPermissions = [
            'property_view',
        ];
        $buyer?->syncPermissions($buyerPermissions);

        // Agent permissions
        $agentPermissions = [
            'property_view',
            'property_create',
            'property_edit',
        ];
        $agent?->syncPermissions($agentPermissions);
    }
}
