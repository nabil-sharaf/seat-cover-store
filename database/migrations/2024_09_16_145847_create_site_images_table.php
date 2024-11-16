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
        Schema::create('site_images', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable(); // مسار صورة اللوجو
            $table->string('logo_white')->nullable(); // مسار صورة اللوجو
            $table->string('footer_image')->nullable(); // مسار صورة الفوتر
            $table->string('payment_image')->nullable(); // مسار صورة وسائل الدفع
            $table->string('about_us_image')->nullable(); // مسار صورة من نحن
            $table->json('sponsor_images')->nullable();  // Add this column for multiple
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_images');
    }
};
