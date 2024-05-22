<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view orders',
            'create orders',
            'edit orders',
            'delete orders',
            'view purchases',
            'create purchases',
            'edit purchases',
            'delete purchases',
        ];
        $role = Role::findByName('admin');
        foreach ($permissions as $name) {
            $permission = Permission::create(['name' => $name, 'guard_name' => 'web']);
            $role->givePermissionTo($permission);
            $permission->assignRole($role);
        }
    }
}
