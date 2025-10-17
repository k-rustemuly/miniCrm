<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Role::exists()) {
            collect(['admin', 'manager'])->each(function ($roleName) {
                Role::create(['name' => $roleName]);
            });
        }

        if(!Permission::exists()) {
            collect(['manage users', 'view tickets', 'update tickets', 'delete tickets'])->each(function ($permissionName) {
                Permission::create(['name' => $permissionName]);
            });
        }

        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();

        $permissions = Permission::all();

        $adminRole->syncPermissions($permissions);

        $managerRole->syncPermissions(
            $permissions->whereIn('name', ['view tickets', 'update tickets'])
        );
    }
}
