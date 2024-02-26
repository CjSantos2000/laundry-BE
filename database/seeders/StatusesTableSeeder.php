<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => 'Pending',
        ]);
        Status::create([
            'name' => 'Processing',
        ]);
        Status::create([
            'name' => 'Ready for Pickup',
        ]);
        Status::create([
            'name' => 'Delivered',
        ]);
        Status::create([
            'name' => 'Cancelled',
        ]);
        Status::create([
            'name' => 'Successful',
        ]);
        Status::create([
            'name' => 'Available',
        ]);
        Status::create([
            'name' => 'Not Available',
        ]);
        Status::create([
            'name' => 'Reserved',
        ]);
        Status::create([
            'name' => 'Failed',
        ]);
    }
}
