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
        Permission::create(['name' => 'manage doctors']); // CRUD dokter
        Permission::create(['name' => 'manage patients']); // CRUD pasien (opsional, jika admin perlu)
        Permission::create(['name' => 'manage medical records']); // CRUD catatan pemeriksaan pasien
        Permission::create(['name' => 'view own medical records']); // pasien melihat catatan sendiri

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $doctorRole = Role::create(['name' => 'dokter']);
        $patientRole = Role::create(['name' => 'pasien']);

        // Assign Permissions to Roles
        $adminRole->givePermissionTo([
            'manage doctors',
            'manage patients',
            'manage medical records',
        ]);

        $doctorRole->givePermissionTo([
            'manage medical records',
        ]);

        $patientRole->givePermissionTo([
            'view own medical records',
        ]);
    }
}
