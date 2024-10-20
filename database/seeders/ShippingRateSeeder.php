<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\ShippingRate;

class ShippingRateSeeder extends Seeder
{
    public function run()
    {
        ShippingRate::truncate();
        $states = [
            ['state' => 'الرياض', 'shipping_cost' => 50.00],
            ['state' => 'مكة المكرمة', 'shipping_cost' => 60.00],
            ['state' => 'المدينة المنورة', 'shipping_cost' => 65.00],
            ['state' => 'القصيم', 'shipping_cost' => 55.00],
            ['state' => 'المنطقة الشرقية', 'shipping_cost' => 70.00],
            ['state' => 'عسير', 'shipping_cost' => 75.00],
            ['state' => 'تبوك', 'shipping_cost' => 80.00],
            ['state' => 'حائل', 'shipping_cost' => 60.00],
            ['state' => 'الحدود الشمالية', 'shipping_cost' => 90.00],
            ['state' => 'جازان', 'shipping_cost' => 85.00],
            ['state' => 'نجران', 'shipping_cost' => 90.00],
            ['state' => 'الباحة', 'shipping_cost' => 80.00],
            ['state' => 'الجوف', 'shipping_cost' => 75.00],
        ];

        foreach ($states as $state) {
            ShippingRate::create($state);
        }
    }
}
