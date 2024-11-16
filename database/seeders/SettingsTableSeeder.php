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
            'setting_key' => 'social_link',
            'setting_value' => '',
            'setting_type' => 'select',
            'description' => 'لينك سوشيال متغير',
            'hide'=>null,
            ],

            [
                'setting_key' => 'social_link_2',
                'setting_value' => '',
                'setting_type' => 'select',
                'description' => 'لينك سوشيال متغير 2',
                'hide'=>null,

            ],
            [
                'setting_key' => 'shipping_title',
                'setting_value' => 'شحن سريع ',
                'setting_type' => 'string',
                'description' => 'رسالة الشحن ',
                'hide'=>null,
            ],
            [
                'setting_key' => 'appointments',
                'setting_value' => 'من السبت للخميس 8 ص : 9 م  ',
                'setting_type' => 'string',
                'description' => 'المواعيد  ',
                'hide'=>null
            ],
            [
            'setting_key' => 'footer_desc',
                'setting_value' => 'شركتنا متخصصة في تصميم وتصنيع الأرضيات -التلبيسات- الفاخرة للسيارات بجميع أنواعها وموديلاتها. مع سنوات من الخبرة العملية في السوق السعودي',
                'setting_type' => 'text',
                'description' => 'الوصف في الفوتر  ',
                'hide'=>null
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
