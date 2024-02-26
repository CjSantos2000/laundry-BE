<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShopAdminSubscription;

class ShopAdminSubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate = Carbon::now();
        $expirationDate = $currentDate->copy()->addYear();

        ShopAdminSubscription::create([
            'shop_admin_id' => 4,
            'subscription_id' => 2,
            'status_id' => 6,
            'payment_screenshot' => 'null',
            'created_at' => $currentDate,
            'expiration_at' => $expirationDate,
        ]);
    }
}
