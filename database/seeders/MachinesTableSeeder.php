<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;

class MachinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Machine::create([
            'shop_admin_id' => 4,
            'machine_type_id' => 1,
            'name' => "SRX-1",
            'status_id' => 1,
        ]);
        Machine::create([
            'shop_admin_id' => 4,
            'machine_type_id' => 2,
            'name' => "SRX-2",
            'status_id' => 1,
        ]);
    }
}
