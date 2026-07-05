<?php

namespace Database\Seeders;

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
        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'manage role-permissions',
            
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view books',
            'create books',
            'edit books',
            'delete books',

            'view borrow',
            'borrow books',
            'return books', 
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'Admin'
        ]);
        $admin->syncPermissions(Permission::all());

        $petugas = Role::firstOrCreate([
            'name' => 'Petugas'
        ]);
        $petugas->syncPermissions([
            'view categories',
            'create categories',
            'edit categories',

            'view books',
            'create books',
            'edit books',
            
            'view borrow',
            'return books',
        ]);


        $user = Role::firstOrCreate([
            'name' => 'User'
        ]);
        $user->syncPermissions([
            'view categories',
            'view books',
            'borrow books',
            'view borrow',
        ]);
    }
}
