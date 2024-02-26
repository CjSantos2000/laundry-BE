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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('transaction_mode_id');
            $table->integer('shop_admin_id');
            $table->integer('service_id');
            $table->integer('garment_id');
            $table->integer('machine_id')->nullable();
            $table->integer('additional_service_id')->nullable();
            $table->string('name');
            $table->string('quantity');
            $table->string('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
