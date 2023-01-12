<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin',            'guard_name' => 'web']);
        Role::create(['name' => 'كاتب مقالات',      'guard_name' => 'web']);

        Permission::create(['name' => 'read-roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'create-role', 'guard_name' => 'web']);
        Permission::create(['name' => 'update-role', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete-role', 'guard_name' => 'web']);

        Permission::create(['name' => 'read-users', 'guard_name' => 'web']);
        Permission::create(['name' => 'create-user', 'guard_name' => 'web']);
        Permission::create(['name' => 'update-user', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete-user', 'guard_name' => 'web']);

        Permission::create(['name' => 'read-pages', 'guard_name' => 'web']);
        Permission::create(['name' => 'create-page', 'guard_name' => 'web']);
        Permission::create(['name' => 'update-page', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete-page', 'guard_name' => 'web']);

        Permission::create(['name' => 'read-categories', 'guard_name' => 'web']);
        Permission::create(['name' => 'create-category', 'guard_name' => 'web']);
        Permission::create(['name' => 'update-category', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete-category', 'guard_name' => 'web']);

        Permission::create(['name' => 'read-posts', 'guard_name' => 'web']);
        Permission::create(['name' => 'create-post', 'guard_name' => 'web']);
        Permission::create(['name' => 'update-post', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete-post', 'guard_name' => 'web']);

        Permission::create(['name' => 'read-contacts', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete-contact', 'guard_name' => 'web']);
    }
}
