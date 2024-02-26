<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscription;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create([
            'name' => '1 Month',
            'price' => 10
        ]); 
        Subscription::create([
            'name' => '1 Year',
            'price' => 20
        ]); 
    }
}
