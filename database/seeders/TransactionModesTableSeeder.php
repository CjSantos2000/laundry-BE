<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionMode;

class TransactionModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionMode::create([
            'name' => 'Self Service',
            'shop_admin_id' => 4,
            'price' => '99'
        ]); 
        TransactionMode::create([
            'name' => 'Pickup and Delivery',
            'shop_admin_id' => 4,
            'price' => '99'
        ]);
        TransactionMode::create([
            'name' => 'Pickup Only',
            'shop_admin_id' => 4,
            'price' => '99'
        ]);
        TransactionMode::create([
            'name' => 'Dropoff',
            'shop_admin_id' => 4,
            'price' => '99'
        ]);
        TransactionMode::create([
            'name' => 'Dropoff and Delivery',
            'shop_admin_id' => 4,
            'price' => '99'
        ]);
    }
}
