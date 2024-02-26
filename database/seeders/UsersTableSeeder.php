<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'first_name' => 'Customer',
            'last_name' => 'Test',
            'address' => 'Rizal',
            'phone_number' => '09557735516',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('customer123')
        ]);
        User::create([
            'role_id' => 2,
            'shop_admin_id' => 4,
            'first_name' => 'Staff',
            'last_name' => 'Test',
            'address' => 'Rizal',
            'phone_number' => '09557735516',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('staff123')
        ]);
        User::create([
            'role_id' => 3,
            'shop_admin_id' => 4,
            'first_name' => 'Rider',
            'last_name' => 'Test',
            'address' => 'Rizal',
            'phone_number' => '09557735516',
            'email' => 'rider@gmail.com',
            'password' => bcrypt('rider123')
        ]);
        User::create([
            'role_id' => 4,
            'shop_name' => "Wash Ease Laundry",
            'first_name' => 'Shop Admin',
            'last_name' => 'Test',
            'address' => 'Rizal',
            'phone_number' => '09557735516',
            'email' => 'shopadmin@gmail.com',
            'password' => bcrypt('shopadmin123')
        ]);
        User::create([
            'role_id' => 5,
            'first_name' => 'Super Admin',
            'last_name' => 'Test',
            'address' => 'Rizal',
            'phone_number' => '09557735516',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin123')
        ]);
    }
}
