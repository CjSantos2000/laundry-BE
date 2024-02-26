<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Garment;

class GarmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Garment::create([
            'name' => 'Regular Clothes',
            'shop_admin_id' => 4,
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis explicabo nobis veniam dicta iure saepe odio pariatur nemo delectus modi!",
            'price' => '99'
        ]);
        Garment::create([
            'name' => 'Maong Pants & Thick Jacket',
            'shop_admin_id' => 4,
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis explicabo nobis veniam dicta iure saepe odio pariatur nemo delectus modi!",
            'price' => '99'
        ]);
    }
}
