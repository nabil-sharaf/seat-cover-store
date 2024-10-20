<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // تعطيل التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('seat_counts')->truncate();

// إعادة تمكين التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::create('seat_counts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_counts');
    }
};
