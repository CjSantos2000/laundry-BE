<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_admin_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_admin_id');
            $table->integer('subscription_id');
            $table->integer('status_id');
            $table->string('payment_screenshot');
            $table->timestamp('created_at')->default(now())->nullable();
            $table->timestamp('expiration_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_admin_subscriptions');
    }
};
