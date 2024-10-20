<?php

namespace Database\Seeders;

use App\Models\Admin\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();

        DB::table('settings')->insert([
            [
                'setting_key' => 'site_name',
                'setting_value' => 'seatCover Store',
                'setting_type' => 'string',
                'description' => 'اسم الموقع',
                'hide'=>null

            ],
            [
                'setting_key' => 'email',
                'setting_value' => 'admin@seat-cover.com',
                'setting_type' => 'string',
                'description' => 'البريد الالكتروني',
                'hide'=>null
            ],
            [
                'setting_key' => 'phone',
                'setting_value' => '01010000000',
                'setting_type' => 'string',
                'description' => 'رقم التواصل',
                'hide'=>null
            ],
            [
                'setting_key' => 'address',
                'setting_value' => 'جدة - السعودية',
                'setting_type' => 'string',
                'description' => 'العنوان ',
                'hide'=>null
            ],
            [
                'setting_key' => 'about_us',
                'setting_value' => 'مرحبا بكم في موقعنا',
                'setting_type' => 'text',
                'description' => 'من نحن ',
                'hide'=>null
            ],
            [
                'setting_key' => 'facebook',
                'setting_value' => 'https://www.facebook.com',
                'setting_type' => 'string',
                'description' => 'facebook',
                'hide'=>null
            ],
            [
                'setting_key' => 'insta',
                'setting_value' => 'https://www.instagram.com/',
                'setting_type' => 'string',
                'description' => 'instagram',
                'hide'=>null
            ],
            [
                'setting_key' => 'whats-app',
                'setting_value' => 'https://wa.me/2010304050',
                'setting_type' => 'string',
                'description' => 'واتساب',
                'hide'=>null
            ],
            [
                'setting_key' => 'shipping_title',
                'setting_value' => 'شحن سريع ',
                'setting_type' => 'string',
                'description' => 'رسالة الشحن ',
                'hide'=>null
            ],
            [
                'setting_key' => 'slider_subject_ar',
                'setting_value' => 'مرحبا بكم في موقعنا',
                'setting_type' => 'string',
                'description' => '',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'slider_desc_ar',
                'setting_value' => '',
                'setting_type' => 'string',
                'description' => '',
                'hide'=>'hide',

            ],
            [
                'setting_key' => 'deal_of_day_subject_ar',
                'setting_value' => 'Deal of the day',
                'setting_type' => 'string',
                'description' => 'عنوان عروض deal of the day',
                'hide'=>'hide',

            ],
            [
                'setting_key' => 'deal_of_day_desc_ar',
                'setting_value' => 'خصومات تصل حتى 35 % على ملابس الأطفال',
                'setting_type' => 'text',
                'description' => 'وصف عروض deal of the day',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'Trending_products_subject',
                'setting_value' => 'Trending Products',
                'setting_type' => 'string',
                'description' => 'عنوان Trending Product',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'Trending_products_desc',
                'setting_value' => 'المنتجات الأشهر والأكثر إقبالا خلال الفترة الحالية',
                'setting_type' => 'string',
                'description' => 'وصف Trending Product',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'pagination_count',
                'setting_value' => 25,
                'setting_type' => 'integer',
                'description' => 'أقصى عدد للمنتجات في الصفحة',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'last_added_count',
                'setting_value' => 8,
                'setting_type' => 'integer',
                'description' => 'عدد منتجات المضاف حديثا في الرئيسية',
                'hide'=>'hide',

            ],
            [
                'setting_key' => 'best_seller_count',
                'setting_value' => 8,
                'setting_type' => 'integer',
                'description' => 'عدد منتجات الأكثر مبيعا في الرئيسية',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'trending_count',
                'setting_value' => 8,
                'setting_type' => 'integer',
                'description' => 'عدد منتجات  التريندينج في الرئيسية',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'goomla_min_number',
                'setting_value' => 1,
                'setting_type' => 'integer',
                'description' => 'أقل عدد قطع في الأوردر لعميل الجملة',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'goomla_min_prices',
                'setting_value' => 1,
                'setting_type' => 'integer',
                'description' => 'اقل سعر للاوردر لعميل الجملة',
                'hide'=>'hide',
            ],
            [
                'setting_key' => 'tax_rate',
                'setting_value' => 15,
                'setting_type' => 'dicimal',
                'description' => '  القيمة المضافة بالنسبة المئوية ',
                'hide'=>null
            ],
            [
                'setting_key' => 'Maintenance_mode',
                'setting_value' => 0,
                'setting_type' => 'select',
                'description' => 'وضع الصيانة',
                'hide'=>null
            ],
        ]);
    }
}
