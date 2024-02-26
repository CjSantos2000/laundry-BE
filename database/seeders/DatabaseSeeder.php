<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdditionalServicesTableSeeder::class);
        $this->call(MachineTypesTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(TransactionModesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GarmentsTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
        $this->call(MachinesTableSeeder::class);
        $this->call(ShopAdminSubscriptionsTableSeeder::class);
    }
}
