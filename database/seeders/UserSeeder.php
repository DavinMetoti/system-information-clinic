<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasienUser = User::create([
            'name'      => 'Pasien',
            'email'     => 'pasien@example.com',
            'password'  => bcrypt('password'),
            'gender'    => 'Laki-laki',
            'contact'   => '081234567890',
            'address'   => 'Jl. Pasien No. 1',
            'role'      => 'pasien',
            'is_active' => true,
        ]);
        $pasienUser->assignRole('pasien');
        DB::table('user_pasiens')->insert([
            'user_id'        => $pasienUser->id,
            'pasien_number'  => 100000001,
            'bpjs_number'    => 'BPJS1234567890',
            'date_of_birth'  => '1990-01-01',
            'place_of_birth' => 'Jakarta',
            'blood_type'     => 'O',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        $dokterUser = User::create([
            'name'      => 'Dokter',
            'email'     => 'dokter@example.com',
            'password'  => bcrypt('password'),
            'gender'    => 'Laki-laki',
            'contact'   => '081234567890',
            'address'   => 'Jl. Dokter No. 2',
            'role'      => 'dokter',
            'is_active' => true,
        ]);
        $dokterUser->assignRole('dokter');
        DB::table('user_doctors')->insert([
            'user_id'            => $dokterUser->id,
            'specialization_id'  => 1,
            'license_number'     => 'SIP123456',
            'registration_number'=> 200000001,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        $adminUser = User::create([
            'name'      => 'Admin Klinik',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'address'   => 'Jl. Admin No. 3',
            'role'      => 'admin',
            'is_active' => true,
        ]);
        $adminUser->assignRole('admin');
    }
}
