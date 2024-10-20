<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;
class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // تعطيل التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('categories')->truncate();

// إعادة تمكين التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Category::create(['name' => 'تلبيسة دايموند', 'description' => '','parent_id'=>null]);
        Category::create(['name' => 'تلبيسة فاخر', 'description' => ' ','parent_id'=>null]);
        Category::create(['name' => ' تلبيسة مثلثات', 'description' => ' ','parent_id'=>null]);
        Category::create(['name' => ' تلبيسة ليزر', 'description' => '','parent_id'=>null]);
    }
}
