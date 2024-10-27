<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
        public function run(): void
        { 
            $permissions = [
            // user table
            'view-users',
            'create-user',
            'edit-user',
            'delete-user',

            // roles table
            'view-roles',
            'create-role',
            'edit-role',
            'delete-role',
        ];

        foreach($permissions as $permission){
            Permission::create(['name'=>$permission]);
        }
    }
}
