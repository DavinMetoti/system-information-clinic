<?php

namespace Database\Seeders;

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
        Permission::create(['name' => 'manage doctors']);
        Permission::create(['name' => 'manage medical records']);
        Permission::create(['name' => 'view own medical records']);
        Permission::create(['name' => 'manage patients']);

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $doctorRole = Role::create(['name' => 'dokter']);
        $patientRole = Role::create(['name' => 'pasien']);

        // Assign Permissions to Roles
        $adminRole->givePermissionTo([
            'manage doctors',
        ]);

        $doctorRole->givePermissionTo([
            'manage medical records',
            'manage patients',
        ]);

        $patientRole->givePermissionTo([
            'view own medical records',
        ]);
    }
}
