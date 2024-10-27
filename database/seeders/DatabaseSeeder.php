<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class,
        ]);

        $rol = Role::create(['name' => 'Admin']);

        $permisos = Permission::pluck('id')->all();
        $adminPermissions = Permission::whereIn('name', [  
        'view-users',
        'create-user',
        'edit-user',
        'delete-user',

        // roles table
        'view-roles',
        'create-role',
        'edit-role',
        'delete-role',

        ])->pluck('id');

        $rol->syncPermissions($adminPermissions);

        $user = User::create([
            'name' => 'Admin',
            'last_name' => 'Test',
            'email' => 'admin@test.com',
            'phone' => '9492345678',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('Admin');

        $userRole = Role::create(['name' => 'User']);

        $userPermissions = Permission::whereIn('name', [
            'view-users',
            ])->pluck('id');
        $userRole->syncPermissions($userPermissions);

        $user2 = User::create([
            'name' => 'User',
            'last_name' => 'Test',
            'email' => 'user@test.com',
            'phone' => '9492345678',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ]);

        $user2->assignRole('User');
    }
}
