<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
// تعطيل التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('products')->truncate();

// إعادة تمكين التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = Category::all();
            Product::create([
                'name' => 'أسود مطرز نسيج جملي',
                'description' => 'أسود مطرز نسيج جملي',
                'quantity' => rand(10, 100),
                'price' => rand(500, 1000),
                'goomla_price'=>rand(100,450),
            ]);

            Product::create([
                'name' => 'أسود مطرز نسيج بيج',
                'description' => 'أسود مطرز نسيج بيج   '  ,
                'quantity' => rand(10, 100),
                'price' => rand(500, 1000),
                'goomla_price'=>rand(100,450),
                ]);

            Product::create([
                'name' => 'أسود مطرز نسيج أحمر',
                'description' => 'أسود مطرز نسيج أحمر   '  ,
                'quantity' => rand(10, 100),
                'price' => rand(500, 1000),
                'goomla_price'=>rand(100,450),
                ]);

            Product::create([
                'name' => 'بني مطرز نسيج جملي',
                'description' => 'بني مطرز نسيج جملي   '  ,
                'quantity' => rand(10, 100),
                'price' => rand(500, 1000),
                'goomla_price'=>rand(100,450),
                ]);

            Product::create([
                'name' => 'بني مطرز نسيج بيج',
                'description' => 'بني مطرز نسيج بيج   '  ,
                'quantity' => rand(10, 100),
                'price' => rand(500, 1000),
                'goomla_price'=>rand(100,450),
                ]);

            Product::create([
                'name' => 'أسود مطرز نسيج عنابي',
                'description' => 'أسود مطرز نسيج عنابي   '  ,
                'quantity' => rand(10, 100),
                'price' => rand(500, 1000),
                'goomla_price'=>rand(100,450),
                ]);

            Product::create([
                'name' => 'رصاصي مطرز نسيج بيج',
                'description' => 'رصاصي مطرز نسيج بيج   '  ,
                'quantity' => rand(10, 100),
                'price' => rand(500, 1000),
                'goomla_price'=>rand(100,450),
                ]);

        }

}

