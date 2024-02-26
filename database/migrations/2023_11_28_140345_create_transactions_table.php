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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_admin_id');
            $table->integer('customer_id');
            $table->integer('status_id');
            $table->integer('payment_method_id');
            $table->string('name');
            $table->string('address');
            $table->string('date');
            $table->string('time');
            $table->string('special_instruction')->nullable();
            $table->string('payment_screenshot')->nullable();
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
