<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole('admin');

        $cashierUser = User::create([
            'name' => 'Cashier User',
            'email' => 'cashier@example.com',
            'password' => bcrypt('password'),
        ]);
        $cashierUser->assignRole('cashier');

        $warehouseUser = User::create([
            'name' => 'Warehouse User',
            'email' => 'warehouse@example.com',
            'password' => bcrypt('password'),
        ]);
        $warehouseUser->assignRole('warehouse');

        $customerUser = User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
        ]);
        $customerUser->assignRole('customer');
    }
}
