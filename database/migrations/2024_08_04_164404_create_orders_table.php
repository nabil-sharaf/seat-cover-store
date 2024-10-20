<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('guest_address_id')->nullable();
            $table->unsignedBigInteger('user_address_id')->nullable();
            $table->unsignedBigInteger('promocode_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->decimal('total_price', 8, 2);
            $table->decimal('promo_discount', 8, 2)->default(0.00);
            $table->decimal('total_after_discount', 8, 2);
            $table->decimal('shipping_cost', 8, 2);
            $table->decimal('tax_amount', 8, 2);
            $table->decimal('final_total', 8, 2);
            $table->timestamps();  // For created_at and updated_at columns

            // Foreign key constraints
             $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
             $table->foreign('guest_address_id')->references('id')->on('guest_addresses')->onDelete('set null');
             $table->foreign('user_address_id')->references('id')->on('user_addresses')->onDelete('set null');
             $table->foreign('promocode_id')->references('id')->on('promo_codes')->onDelete('set null');
             $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
