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

        Category::create(['product_type'=>'earth','name' => 'تلبيسات أرضيات ', 'description' => 'اجعل ارضية سيارتك اكثر اناقة واضف لمسة جمال لسيارتك','parent_id'=>null]);
        Category::create(['product_type'=>'seat' , 'name' => 'تلبيسات مقاعد ', 'description' => 'اضف لمسة جمال لمقاعد سيارتك بتلبيسات مميزة من آل اسماعيل','parent_id'=>null]);
        Category::create(['product_type'=>'accessory', 'name' => ' اكسسوارات ', 'description' => 'جميع انواع الاكسسوارات التي تحتاجها تجدها في مؤسسة  آل اسماعيل ','parent_id'=>null]);
        Category::create(['product_type'=>'earth','name' => ' تلبيسة دياموند ', 'description' => 'تابعة للأرضيات','parent_id'=>1]);
        Category::create(['product_type'=>'earth','name' => ' تلبيسة فاخر ', 'description' => 'تابعة للأرضيات','parent_id'=>1]);
        Category::create(['product_type'=>'earth','name' => 'تلبيسة مثلثات  ', 'description' => 'تابعة للأرضيات','parent_id'=>1]);
        Category::create(['product_type'=>'earth','name' => ' تلبيسة ليزر ', 'description' => 'تابعة للأرضيات','parent_id'=>1]);
        Category::create(['product_type'=>'seat','name' => ' تلبيسة جلد ', 'description' => 'تابعة للمقاعد','parent_id'=>2]);
        Category::create(['product_type'=>'seat','name' => ' تلبيسة قماش ', 'description' => 'تابعة للمقاعد','parent_id'=>2]);
    }
}
