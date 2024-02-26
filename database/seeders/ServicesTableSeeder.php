<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'shop_admin_id' => 4,
            'name' => 'Basic Services (Wash, Dry, Fold)',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis explicabo nobis veniam dicta iure saepe odio pariatur nemo delectus modi!",
            'price' => 20
        ]);
        Service::create([
            'shop_admin_id' => 4,
            'name' => 'Ironing',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis explicabo nobis veniam dicta iure saepe odio pariatur nemo delectus modi!",
            'price' => 20
        ]);
        Service::create([
            'shop_admin_id' => 4,
            'name' => 'Dry Cleaning',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis explicabo nobis veniam dicta iure saepe odio pariatur nemo delectus modi!",
            'price' => 20
        ]);
    }
}
