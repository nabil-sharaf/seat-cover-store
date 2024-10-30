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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // BIGINT
            $table->unsignedBigInteger('category_id')->nullable(); // BIGINT
            $table->unsignedBigInteger('accessory_id')->nullable(); // BIGINT
            $table->unsignedBigInteger('color_id')->nullable(); // BIGINT
            $table->unsignedBigInteger('seat_count_id')->nullable(); // BIGINT
            $table->unsignedBigInteger('brand_id')->nullable(); // BIGINT
            $table->unsignedBigInteger('model_id')->nullable();// BIGINT
            $table->tinyInteger('bag_option')->nullable(); // tinyInt
            $table->unsignedInteger('quantity');
            $table->string('made_years')->nullable(); // BIGINT
            $table->decimal('unit_price', 8, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); // Order table
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('accessory_id')->references('id')->on('accessories');
            $table->foreign('color_id')->references('id')->on('products');
            $table->foreign('seat_count_id')->references('id')->on('seat_counts');
            $table->foreign('brand_id')->references('id')->on('car_brands');
            $table->foreign('model_id')->references('id')->on('car_models');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
