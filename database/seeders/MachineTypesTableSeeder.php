<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MachineType;

class MachineTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MachineType::create([
            'name' => 'Wash',
        ]);
        MachineType::create([
            'name' => 'Dry',
        ]);
    }
}
