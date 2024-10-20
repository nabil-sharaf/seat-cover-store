<?php

namespace Database\Seeders;

use App\Models\Admin\CarBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // تعطيل التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('car_brands')->truncate();

// إعادة تمكين التحقق من المفاتيح الأجنبية
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $carBrands = [
            ['brand_name' => 'Toyota'],
            ['brand_name' => 'Honda'],
            ['brand_name' => 'Nissan'],
            ['brand_name' => 'BMW'],
            ['brand_name' => 'Mercedes-Benz'],
            ['brand_name' => 'Audi'],
            ['brand_name' => 'Ford'],
            ['brand_name' => 'Chevrolet'],
            ['brand_name' => 'Kia'],
            ['brand_name' => 'Hyundai'],
            ['brand_name' => 'Volkswagen'],
            ['brand_name' => 'Porsche'],
            ['brand_name' => 'Lexus'],
            ['brand_name' => 'Subaru'],
            ['brand_name' => 'Mazda'],
            ['brand_name' => 'Ferrari'],
            ['brand_name' => 'Lamborghini'],
            ['brand_name' => 'Jaguar'],
            ['brand_name' => 'Tesla'],
            ['brand_name' => 'Mitsubishi'],
            ['brand_name' => 'Peugeot'],
            ['brand_name' => 'Renault'],
            ['brand_name' => 'Volvo'],
            ['brand_name' => 'Land Rover'],
            ['brand_name' => 'Bugatti'],
            ['brand_name' => 'Bentley'],
            ['brand_name' => 'Rolls-Royce'],
            ['brand_name' => 'Aston Martin'],
            ['brand_name' => 'BWD'],
            ['brand_name' => 'JAC'],
            ['brand_name' => 'GMC'],
            ['brand_name' => 'Isuzu'],
            ['brand_name' => 'Acura'],
            ['brand_name' => 'Infiniti'],
            ['brand_name' => 'Exeed'],
            ['brand_name' => 'Chery'],
            ['brand_name' => 'BYD'],
            ['brand_name' => 'Geely'],
            ['brand_name' => 'Dongfeng'],
            ['brand_name' => 'Haval'],
            ['brand_name' => 'Great Wall'],
            ['brand_name' => 'Daihatsu'],
            ['brand_name' => 'Ram'],
            ['brand_name' => 'SsangYong'],
            ['brand_name' => 'Dodge'],
            ['brand_name' => 'Jeep'],
            ['brand_name' => 'Fiat'],
            ['brand_name' => 'Alfa Romeo'],
            ['brand_name' => 'Genesis'],
            ['brand_name' => 'Citroën'],
            ['brand_name' => 'Opel'],
            ['brand_name' => 'SEAT'],
            ['brand_name' => 'Skoda'],
            ['brand_name' => 'Maserati'],
            ['brand_name' => 'Mini'],
            ['brand_name' => 'Suzuki'],
            // إضافة المزيد من العلامات التجارية المشهورة
            ['brand_name' => 'Tata'],
            ['brand_name' => 'Mahindra'],
            ['brand_name' => 'Lincoln'],
            ['brand_name' => 'Cadillac'],
            ['brand_name' => 'Chrysler'],
            ['brand_name' => 'Saab'],
            ['brand_name' => 'Pagani'],
            ['brand_name' => 'Koenigsegg'],
            ['brand_name' => 'Spyker'],
            ['brand_name' => 'McLaren'],
            ['brand_name' => 'Rivian'],
            ['brand_name' => 'Lucid Motors'],
            ['brand_name' => 'Polestar'],
            ['brand_name' => 'Fisker'],
            ['brand_name' => 'Roewe'],
            ['brand_name' => 'Wuling'],
            ['brand_name' => 'Zotye'],
            ['brand_name' => 'Baojun'],
            ['brand_name' => 'Scania'],
            ['brand_name' => 'MAN'],
            ['brand_name' => 'Iveco'],
            ['brand_name' => 'Foton'],
        ];

        foreach ($carBrands as $brand) {
            CarBrand::create($brand);
        }
    }
}
