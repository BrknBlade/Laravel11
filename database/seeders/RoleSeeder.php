<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin']);
        $commonUser = Role::create(['name' => 'common_user']);

        $permission_create_newspaper = Permission::create(['name' => 'create newspaper']);
        $permission_edit_newspaper = Permission::create(['name' => 'edit newspaper']);
        $permission_delete_newspaper = Permission::create(['name' => 'delete newspaper']);

        $admin_permissions = [$permission_create_newspaper, $permission_edit_newspaper, $permission_delete_newspaper];

        $admin->syncPermissions($admin_permissions);
    }
}
