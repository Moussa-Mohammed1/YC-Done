<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view restaurants',
            'create restaurants',
            'edit restaurants',
            'delete restaurants',
            'view menus',
            'create menus',
            'edit menus',
            'delete menus',
            'view plats',
            'create plats',
            'edit plats',
            'delete plats',
            'manage users',
            'manage roles',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $ownerRole = Role::create(['name' => 'restaurant_owner']);
        $ownerRole->givePermissionTo([
            'view restaurants',
            'create restaurants',
            'edit restaurants',
            'view menus',
            'create menus',
            'edit menus',
            'view plats',
            'create plats',
            'edit plats',
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'view restaurants',
            'view menus',
            'view plats',
        ]);
    }
}
