<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdditionalService;

class AdditionalServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdditionalService::create([
            'service_id' => 1,
            'name' => 'Wash Only',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis explicabo nobis veniam dicta iure saepe odio pariatur nemo delectus modi!",
            'price' => 20
        ]);
        AdditionalService::create([
            'service_id' => 1,
            'name' => 'Dry Only',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis explicabo nobis veniam dicta iure saepe odio pariatur nemo delectus modi!",
            'price' => 20
        ]);
        AdditionalService::create([
            'service_id' => 1,
            'name' => 'Full Service',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis explicabo nobis veniam dicta iure saepe odio pariatur nemo delectus modi!",
            'price' => 20
        ]);
    }
}
