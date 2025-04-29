<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create Permissions
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'view sales']);
        Permission::create(['name' => 'create sales']);
        Permission::create(['name' => 'manage stock']);
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'create users']);

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $cashierRole = Role::create(['name' => 'cashier']);
        $warehouseRole = Role::create(['name' => 'warehouse']);
        $customerRole = Role::create(['name' => 'customer']);

        // Assign Permissions to Roles
        $adminRole->givePermissionTo(Permission::all());

        $cashierRole->givePermissionTo([
            'view products',
            'create sales',
            'view sales',
            'manage stock',
        ]);

        $warehouseRole->givePermissionTo([
            'view products',
            'manage stock',
        ]);

        $customerRole->givePermissionTo([
            'view products',
        ]);
    }

}
