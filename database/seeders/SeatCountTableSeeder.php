<?php

namespace Database\Seeders;

use App\Models\Admin\CarModel;
use App\Models\Admin\SeatCount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatCountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تعطيل التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('car_models')->truncate();

// إعادة تمكين التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $seats =[
            ['name' => 'مقعدين'],
            ['name' => '5 مقاعد'],
            ['name' => '7 مقاعد'],
            ['name' => '9 مقاعد'],

        ];
        foreach ($seats as $seat) {
            SeatCount::create($seat);
        }
    }

}
