<?php

namespace Database\Seeders;

use App\Models\Admin\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelsSeeder extends Seeder
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
        $carModels = [
            // Toyota (brand_id: 1)
            ['model_name' => 'Camry', 'brand_id' => 1, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Corolla', 'brand_id' => 1, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'RAV4', 'brand_id' => 1, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Highlander', 'brand_id' => 1, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Sienna', 'brand_id' => 1, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Land Cruiser', 'brand_id' => 1, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],
            ['model_name' => 'HiAce', 'brand_id' => 1, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Honda (brand_id: 2)
            ['model_name' => 'Civic', 'brand_id' => 2, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Accord', 'brand_id' => 2, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'CR-V', 'brand_id' => 2, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Pilot', 'brand_id' => 2, 'made_year_from' => 2002, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'S2000', 'brand_id' => 2, 'made_year_from' => 2000, 'made_year_to' => 2009, 'seat_count_id' => 1],
            ['model_name' => 'Odyssey', 'brand_id' => 2, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Nissan (brand_id: 3)
            ['model_name' => 'Altima', 'brand_id' => 3, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Rogue', 'brand_id' => 3, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Pathfinder', 'brand_id' => 3, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'GT-R', 'brand_id' => 3, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Armada', 'brand_id' => 3, 'made_year_from' => 2003, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'NV350', 'brand_id' => 3, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],
            ['model_name' => 'Patrol', 'brand_id' => 3, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // BMW (brand_id: 4)
            ['model_name' => '3 Series', 'brand_id' => 4, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'X5', 'brand_id' => 4, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'M3', 'brand_id' => 4, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'i8', 'brand_id' => 4, 'made_year_from' => 2014, 'made_year_to' => 2020, 'seat_count_id' => 1],
            ['model_name' => 'X7', 'brand_id' => 4, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'X7', 'brand_id' => 4, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Mercedes-Benz (brand_id: 5)
            ['model_name' => 'C-Class', 'brand_id' => 5, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'E-Class', 'brand_id' => 5, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'S-Class', 'brand_id' => 5, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'G-Class', 'brand_id' => 5, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'AMG GT', 'brand_id' => 5, 'made_year_from' => 2014, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'V-Class', 'brand_id' => 5, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Audi (brand_id: 6)
            ['model_name' => 'A4', 'brand_id' => 6, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Q5', 'brand_id' => 6, 'made_year_from' => 2008, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'R8', 'brand_id' => 6, 'made_year_from' => 2006, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Q7', 'brand_id' => 6, 'made_year_from' => 2005, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'TT', 'brand_id' => 6, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],

            // Ford (brand_id: 7)
            ['model_name' => 'F-150', 'brand_id' => 7, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Mustang', 'brand_id' => 7, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Explorer', 'brand_id' => 7, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Focus', 'brand_id' => 7, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Expedition', 'brand_id' => 7, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Transit', 'brand_id' => 7, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],
            ['model_name' => 'Expedition', 'brand_id' => 7, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Chevrolet (brand_id: 8)
            ['model_name' => 'Silverado', 'brand_id' => 8, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Camaro', 'brand_id' => 8, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Tahoe', 'brand_id' => 8, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Suburban', 'brand_id' => 8, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],
            ['model_name' => 'Corvette', 'brand_id' => 8, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Express', 'brand_id' => 8, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Kia (brand_id: 9)
            ['model_name' => 'Sportage', 'brand_id' => 9, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Sorento', 'brand_id' => 9, 'made_year_from' => 2002, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Forte', 'brand_id' => 9, 'made_year_from' => 2008, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Telluride', 'brand_id' => 9, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Stinger', 'brand_id' => 9, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Carnival', 'brand_id' => 9, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Hyundai (brand_id: 10)
            ['model_name' => 'Elantra', 'brand_id' => 10, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Tucson', 'brand_id' => 10, 'made_year_from' => 2004, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Santa Fe', 'brand_id' => 10, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Palisade', 'brand_id' => 10, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Veloster', 'brand_id' => 10, 'made_year_from' => 2011, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'H-1', 'brand_id' => 10, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Volkswagen (brand_id: 11)
            ['model_name' => 'Golf', 'brand_id' => 11, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Passat', 'brand_id' => 11, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Tiguan', 'brand_id' => 11, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Atlas', 'brand_id' => 11, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Arteon', 'brand_id' => 11, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Caravelle', 'brand_id' => 11, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],
            ['model_name' => 'Multivan', 'brand_id' => 11, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Porsche (brand_id: 12)
            ['model_name' => '911', 'brand_id' => 12, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Cayenne', 'brand_id' => 12, 'made_year_from' => 2002, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Panamera', 'brand_id' => 12, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Macan', 'brand_id' => 12, 'made_year_from' => 2014, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Taycan', 'brand_id' => 12, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Lexus (brand_id: 13) continued
            ['model_name' => 'RX', 'brand_id' => 13, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'ES', 'brand_id' => 13, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'IS', 'brand_id' => 13, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'LX', 'brand_id' => 13, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'LC', 'brand_id' => 13, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 1],

            // Subaru (brand_id: 14)
            ['model_name' => 'Outback', 'brand_id' => 14, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Forester', 'brand_id' => 14, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Impreza', 'brand_id' => 14, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Ascent', 'brand_id' => 14, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'BRZ', 'brand_id' => 14, 'made_year_from' => 2012, 'made_year_to' => 2024, 'seat_count_id' => 1],

            // Mazda (brand_id: 15)
            ['model_name' => 'CX-5', 'brand_id' => 15, 'made_year_from' => 2012, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Mazda3', 'brand_id' => 15, 'made_year_from' => 2003, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'CX-9', 'brand_id' => 15, 'made_year_from' => 2006, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'MX-5 Miata', 'brand_id' => 15, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'CX-30', 'brand_id' => 15, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Ferrari (brand_id: 16)
            ['model_name' => 'F8 Tributo', 'brand_id' => 16, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Roma', 'brand_id' => 16, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'SF90 Stradale', 'brand_id' => 16, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => '812 Superfast', 'brand_id' => 16, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Portofino', 'brand_id' => 16, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 1],

            // Lamborghini (brand_id: 17)
            ['model_name' => 'Huracán', 'brand_id' => 17, 'made_year_from' => 2014, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Aventador', 'brand_id' => 17, 'made_year_from' => 2011, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Urus', 'brand_id' => 17, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Sián', 'brand_id' => 17, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Countach LPI 800-4', 'brand_id' => 17, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 1],

            // Jaguar (brand_id: 18)
            ['model_name' => 'F-PACE', 'brand_id' => 18, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'XE', 'brand_id' => 18, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'I-PACE', 'brand_id' => 18, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'F-TYPE', 'brand_id' => 18, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'XF', 'brand_id' => 18, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Tesla (brand_id: 19)
            ['model_name' => 'Model 3', 'brand_id' => 19, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Model S', 'brand_id' => 19, 'made_year_from' => 2012, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Model X', 'brand_id' => 19, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Model Y', 'brand_id' => 19, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Cybertruck', 'brand_id' => 19, 'made_year_from' => 2023, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Mitsubishi (brand_id: 20)
            ['model_name' => 'Outlander', 'brand_id' => 20, 'made_year_from' => 2001, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Eclipse Cross', 'brand_id' => 20, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Pajero Sport', 'brand_id' => 20, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'L200', 'brand_id' => 20, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'ASX', 'brand_id' => 20, 'made_year_from' => 2010, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Delica', 'brand_id' => 20, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Peugeot (brand_id: 21)
            ['model_name' => '208', 'brand_id' => 21, 'made_year_from' => 2012, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => '3008', 'brand_id' => 21, 'made_year_from' => 2008, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => '5008', 'brand_id' => 21, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => '508', 'brand_id' => 21, 'made_year_from' => 2010, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => '2008', 'brand_id' => 21, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Renault (brand_id: 22)
            ['model_name' => 'Clio', 'brand_id' => 22, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Captur', 'brand_id' => 22, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Megane', 'brand_id' => 22, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Koleos', 'brand_id' => 22, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Scenic', 'brand_id' => 22, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],

            // Volvo (brand_id: 23)
            ['model_name' => 'XC90', 'brand_id' => 23, 'made_year_from' => 2002, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'XC60', 'brand_id' => 23, 'made_year_from' => 2008, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'S60', 'brand_id' => 23, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'V90', 'brand_id' => 23, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'C40', 'brand_id' => 23, 'made_year_from' => 2021, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Land Rover (brand_id: 24)
            ['model_name' => 'Range Rover', 'brand_id' => 24, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Discovery', 'brand_id' => 24, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Defender', 'brand_id' => 24, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Range Rover Sport', 'brand_id' => 24, 'made_year_from' => 2005, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Evoque', 'brand_id' => 24, 'made_year_from' => 2011, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Defender 110', 'brand_id' => 24, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Bugatti (brand_id: 25)
            ['model_name' => 'Chiron', 'brand_id' => 25, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Veyron', 'brand_id' => 25, 'made_year_from' => 2005, 'made_year_to' => 2015, 'seat_count_id' => 1],
            ['model_name' => 'Divo', 'brand_id' => 25, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'La Voiture Noire', 'brand_id' => 25, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Centodieci', 'brand_id' => 25, 'made_year_from' => 2021, 'made_year_to' => 2024, 'seat_count_id' => 1],

            // Bentley (brand_id: 26)
            ['model_name' => 'Bentayga', 'brand_id' => 26, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Flying Spur', 'brand_id' => 26, 'made_year_from' => 2005, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Mulsanne', 'brand_id' => 26, 'made_year_from' => 2010, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Rolls-Royce (brand_id: 27)
            ['model_name' => 'Phantom', 'brand_id' => 27, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Ghost', 'brand_id' => 27, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Cullinan', 'brand_id' => 27, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Aston Martin (brand_id: 28)
            ['model_name' => 'DB11', 'brand_id' => 28, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Vantage', 'brand_id' => 28, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'DBS Superleggera', 'brand_id' => 28, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'DBX', 'brand_id' => 28, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Valkyrie', 'brand_id' => 28, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 1],

            // BWD (brand_id: 29)
            ['model_name' => 'BWD-1', 'brand_id' => 29, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'BWD-2', 'brand_id' => 29, 'made_year_from' => 2021, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'BWD-3', 'brand_id' => 29, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'BWD-4', 'brand_id' => 29, 'made_year_from' => 2023, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'BWD-5', 'brand_id' => 29, 'made_year_from' => 2024, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // JAC (brand_id: 30)
            ['model_name' => 'J3', 'brand_id' => 30, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'S3', 'brand_id' => 30, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'T6', 'brand_id' => 30, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'iEV7S', 'brand_id' => 30, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Refine S4', 'brand_id' => 30, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 3],

            // GMC (brand_id: 31)
            ['model_name' => 'Sierra', 'brand_id' => 31, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Yukon', 'brand_id' => 31, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Terrain', 'brand_id' => 31, 'made_year_from' => 2010, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Acadia', 'brand_id' => 31, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Canyon', 'brand_id' => 31, 'made_year_from' => 2004, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Isuzu (brand_id: 32)
            ['model_name' => 'D-Max', 'brand_id' => 32, 'made_year_from' => 2002, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'MU-X', 'brand_id' => 32, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 3],


            // Acura (brand_id: 33)
            ['model_name' => 'MDX', 'brand_id' => 33, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'TLX', 'brand_id' => 33, 'made_year_from' => 2014, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'RDX', 'brand_id' => 33, 'made_year_from' => 2006, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'NSX', 'brand_id' => 33, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'ILX', 'brand_id' => 33, 'made_year_from' => 2012, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Infiniti (brand_id: 34)
            ['model_name' => 'Q50', 'brand_id' => 34, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'QX60', 'brand_id' => 34, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'QX80', 'brand_id' => 34, 'made_year_from' => 2004, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'QX50', 'brand_id' => 34, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Exeed (brand_id: 35)
            ['model_name' => 'TXL', 'brand_id' => 35, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'VX', 'brand_id' => 35, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'LX', 'brand_id' => 35, 'made_year_from' => 2021, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'RX', 'brand_id' => 35, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Star', 'brand_id' => 35, 'made_year_from' => 2023, 'made_year_to' => 2024, 'seat_count_id' => 2],
            // Chery (brand_id: 36)
            ['model_name' => 'Tiggo 7', 'brand_id' => 36, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Arrizo 5', 'brand_id' => 36, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Tiggo 8', 'brand_id' => 36, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'eQ1', 'brand_id' => 36, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Tiggo 4', 'brand_id' => 36, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Tiggo 8', 'brand_id' => 18, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // BYD (brand_id: 37)
            ['model_name' => 'Han', 'brand_id' => 37, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Tang', 'brand_id' => 37, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Song', 'brand_id' => 37, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Yuan', 'brand_id' => 37, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'e6', 'brand_id' => 37, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Geely (brand_id: 38)
            ['model_name' => 'Coolray', 'brand_id' => 38, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Emgrand', 'brand_id' => 38, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Boyue', 'brand_id' => 38, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Azkarra', 'brand_id' => 38, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Okavango', 'brand_id' => 38, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 3],

            // Dongfeng (brand_id: 39)
            ['model_name' => 'AX7', 'brand_id' => 39, 'made_year_from' => 2014, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'S50', 'brand_id' => 39, 'made_year_from' => 2014, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'T5 EVO', 'brand_id' => 39, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Fengon 580', 'brand_id' => 39, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Rich 6', 'brand_id' => 39, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'S50', 'brand_id' => 39, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Haval (brand_id: 40)
            ['model_name' => 'H6', 'brand_id' => 40, 'made_year_from' => 2011, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'F7', 'brand_id' => 40, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'H9', 'brand_id' => 40, 'made_year_from' => 2014, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Jolion', 'brand_id' => 40, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Big Dog', 'brand_id' => 40, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'H6', 'brand_id' => 40, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Great Wall (brand_id: 41)
            ['model_name' => 'Wingle', 'brand_id' => 41, 'made_year_from' => 2006, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Cannon', 'brand_id' => 41, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Pao', 'brand_id' => 41, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Steed', 'brand_id' => 41, 'made_year_from' => 2006, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Hover', 'brand_id' => 41, 'made_year_from' => 2005, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Wingle 5', 'brand_id' => 41, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Daihatsu (brand_id: 42)
            ['model_name' => 'Terios', 'brand_id' => 42, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Sirion', 'brand_id' => 42, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Xenia', 'brand_id' => 42, 'made_year_from' => 2003, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Ayla', 'brand_id' => 42, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Rocky', 'brand_id' => 42, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Ram (brand_id: 43)
            ['model_name' => '1500', 'brand_id' => 43, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => '2500', 'brand_id' => 43, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => '3500', 'brand_id' => 43, 'made_year_from' => 2009, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'ProMaster', 'brand_id' => 43, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'ProMaster City', 'brand_id' => 43, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'ProMaster City', 'brand_id' => 43, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // SsangYong (brand_id: 44)
            ['model_name' => 'Tivoli', 'brand_id' => 44, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Korando', 'brand_id' => 44, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Rexton', 'brand_id' => 44, 'made_year_from' => 2001, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Musso', 'brand_id' => 44, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'XLV', 'brand_id' => 44, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],

            // Dodge (brand_id: 45)
            ['model_name' => 'Challenger', 'brand_id' => 45, 'made_year_from' => 2008, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Charger', 'brand_id' => 45, 'made_year_from' => 2005, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Durango', 'brand_id' => 45, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Journey', 'brand_id' => 45, 'made_year_from' => 2008, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Viper', 'brand_id' => 45, 'made_year_from' => 2000, 'made_year_to' => 2017, 'seat_count_id' => 1],
            ['model_name' => 'Ram Van', 'brand_id' => 45, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

            // Jeep (brand_id: 46)
            ['model_name' => 'Wrangler', 'brand_id' => 46, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Grand Cherokee', 'brand_id' => 46, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Cherokee', 'brand_id' => 46, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Compass', 'brand_id' => 46, 'made_year_from' => 2006, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Gladiator', 'brand_id' => 46, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
// Fiat (brand_id: 47)
            ['model_name' => '500', 'brand_id' => 47, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Panda', 'brand_id' => 47, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Tipo', 'brand_id' => 47, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => '124 Spider', 'brand_id' => 47, 'made_year_from' => 2000, 'made_year_to' => 2020, 'seat_count_id' => 1],
            ['model_name' => 'Ducato', 'brand_id' => 47, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

// Alfa Romeo (brand_id: 48)
            ['model_name' => 'Giulia', 'brand_id' => 48, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Stelvio', 'brand_id' => 48, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => '4C', 'brand_id' => 48, 'made_year_from' => 2013, 'made_year_to' => 2020, 'seat_count_id' => 1],
            ['model_name' => 'Tonale', 'brand_id' => 48, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 2],

// Genesis (brand_id: 49)
            ['model_name' => 'G70', 'brand_id' => 49, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'G80', 'brand_id' => 49, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'G90', 'brand_id' => 49, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'GV70', 'brand_id' => 49, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'GV80', 'brand_id' => 49, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 3],

// Citroën (brand_id: 50)
            ['model_name' => 'C3', 'brand_id' => 50, 'made_year_from' => 2002, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'C4', 'brand_id' => 50, 'made_year_from' => 2004, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'C5', 'brand_id' => 50, 'made_year_from' => 2001, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Berlingo', 'brand_id' => 50, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'SpaceTourer', 'brand_id' => 50, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 4],

// Opel (brand_id: 51)
            ['model_name' => 'Corsa', 'brand_id' => 51, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Astra', 'brand_id' => 51, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Insignia', 'brand_id' => 51, 'made_year_from' => 2008, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Mokka', 'brand_id' => 51, 'made_year_from' => 2012, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Zafira', 'brand_id' => 51, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
// SEAT (brand_id: 52)
            ['model_name' => 'Ibiza', 'brand_id' => 52, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Leon', 'brand_id' => 52, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Ateca', 'brand_id' => 52, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Tarraco', 'brand_id' => 52, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 3],

// Skoda (brand_id: 53)
            ['model_name' => 'Octavia', 'brand_id' => 53, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Superb', 'brand_id' => 53, 'made_year_from' => 2001, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Kodiaq', 'brand_id' => 53, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Karoq', 'brand_id' => 53, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],

// Maserati (brand_id: 54)
            ['model_name' => 'Ghibli', 'brand_id' => 54, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Quattroporte', 'brand_id' => 54, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Levante', 'brand_id' => 54, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'MC20', 'brand_id' => 54, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 1],

// Mini (brand_id: 55)
            ['model_name' => 'Cooper', 'brand_id' => 55, 'made_year_from' => 2001, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Countryman', 'brand_id' => 55, 'made_year_from' => 2010, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Clubman', 'brand_id' => 55, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Convertible', 'brand_id' => 55, 'made_year_from' => 2004, 'made_year_to' => 2024, 'seat_count_id' => 1],

// Suzuki (brand_id: 56)
            ['model_name' => 'Swift', 'brand_id' => 56, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Vitara', 'brand_id' => 56, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Jimny', 'brand_id' => 56, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'S-Cross', 'brand_id' => 56, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 2],

// Tata (brand_id: 57)
            ['model_name' => 'Nexon', 'brand_id' => 57, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Harrier', 'brand_id' => 57, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Safari', 'brand_id' => 57, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Tiago', 'brand_id' => 57, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Winger', 'brand_id' => 57, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

// Mahindra (brand_id: 58)
            ['model_name' => 'Scorpio', 'brand_id' => 58, 'made_year_from' => 2002, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'XUV500', 'brand_id' => 58, 'made_year_from' => 2011, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Thar', 'brand_id' => 58, 'made_year_from' => 2010, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Bolero', 'brand_id' => 58, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Bolero', 'brand_id' => 58, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 4],

// Lincoln (brand_id: 59)
            ['model_name' => 'Navigator', 'brand_id' => 59, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Aviator', 'brand_id' => 59, 'made_year_from' => 2003, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Corsair', 'brand_id' => 59, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Nautilus', 'brand_id' => 59, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            // Cadillac (brand_id: 60)
            ['model_name' => 'Escalade', 'brand_id' => 60, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'CT5', 'brand_id' => 60, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'XT4', 'brand_id' => 60, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'XT6', 'brand_id' => 60, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 3],

// Chrysler (brand_id: 61)
            ['model_name' => '300', 'brand_id' => 61, 'made_year_from' => 2005, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Pacifica', 'brand_id' => 61, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Voyager', 'brand_id' => 61, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Town & Country', 'brand_id' => 61, 'made_year_from' => 2000, 'made_year_to' => 2016, 'seat_count_id' => 3],

// Saab (brand_id: 62)
            ['model_name' => '9-3', 'brand_id' => 62, 'made_year_from' => 2000, 'made_year_to' => 2014, 'seat_count_id' => 2],
            ['model_name' => '9-5', 'brand_id' => 62, 'made_year_from' => 2000, 'made_year_to' => 2012, 'seat_count_id' => 2],
            ['model_name' => '900', 'brand_id' => 62, 'made_year_from' => 2000, 'made_year_to' => 2000, 'seat_count_id' => 2],
            ['model_name' => '9-4X', 'brand_id' => 62, 'made_year_from' => 2011, 'made_year_to' => 2012, 'seat_count_id' => 2],

// Pagani (brand_id: 63)
            ['model_name' => 'Zonda', 'brand_id' => 63, 'made_year_from' => 2000, 'made_year_to' => 2019, 'seat_count_id' => 1],
            ['model_name' => 'Huayra', 'brand_id' => 63, 'made_year_from' => 2012, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Utopia', 'brand_id' => 63, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 1],

// Koenigsegg (brand_id: 64)
            ['model_name' => 'Agera', 'brand_id' => 64, 'made_year_from' => 2011, 'made_year_to' => 2018, 'seat_count_id' => 1],
            ['model_name' => 'Jesko', 'brand_id' => 64, 'made_year_from' => 2021, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Regera', 'brand_id' => 64, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Gemera', 'brand_id' => 64, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 2],

// Spyker (brand_id: 65)
            ['model_name' => 'C8', 'brand_id' => 65, 'made_year_from' => 2000, 'made_year_to' => 2018, 'seat_count_id' => 1],
            ['model_name' => 'C12', 'brand_id' => 65, 'made_year_from' => 2006, 'made_year_to' => 2008, 'seat_count_id' => 1],
            ['model_name' => 'B6 Venator', 'brand_id' => 65, 'made_year_from' => 2013, 'made_year_to' => 2017, 'seat_count_id' => 1],

// McLaren (brand_id: 66)
            ['model_name' => '720S', 'brand_id' => 66, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Artura', 'brand_id' => 66, 'made_year_from' => 2021, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'GT', 'brand_id' => 66, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Senna', 'brand_id' => 66, 'made_year_from' => 2018, 'made_year_to' => 2020, 'seat_count_id' => 1],

// Rivian (brand_id: 67)
            ['model_name' => 'R1T', 'brand_id' => 67, 'made_year_from' => 2021, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'R1S', 'brand_id' => 67, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 3],

// Lucid Motors (brand_id: 68)
            ['model_name' => 'Air', 'brand_id' => 68, 'made_year_from' => 2021, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Gravity', 'brand_id' => 68, 'made_year_from' => 2024, 'made_year_to' => 2024, 'seat_count_id' => 3],

// Polestar (brand_id: 69)
            ['model_name' => 'Polestar 1', 'brand_id' => 69, 'made_year_from' => 2019, 'made_year_to' => 2021, 'seat_count_id' => 2],
            ['model_name' => 'Polestar 2', 'brand_id' => 69, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Polestar 3', 'brand_id' => 69, 'made_year_from' => 2023, 'made_year_to' => 2024, 'seat_count_id' => 2],
            // Fisker (brand_id: 70)
            ['model_name' => 'Ocean', 'brand_id' => 70, 'made_year_from' => 2022, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Karma', 'brand_id' => 70, 'made_year_from' => 2011, 'made_year_to' => 2012, 'seat_count_id' => 2],
            ['model_name' => 'PEAR', 'brand_id' => 70, 'made_year_from' => 2024, 'made_year_to' => 2024, 'seat_count_id' => 2],

// Roewe (brand_id: 71)
            ['model_name' => 'i5', 'brand_id' => 71, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'RX5', 'brand_id' => 71, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Marvel X', 'brand_id' => 71, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 2],

// Wuling (brand_id: 72)
            ['model_name' => 'Hong Guang Mini EV', 'brand_id' => 72, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Asta', 'brand_id' => 72, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Almaz', 'brand_id' => 72, 'made_year_from' => 2018, 'made_year_to' => 2024, 'seat_count_id' => 3],

// Zotye (brand_id: 73)
            ['model_name' => 'T600', 'brand_id' => 73, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Z100', 'brand_id' => 73, 'made_year_from' => 2013, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'SR9', 'brand_id' => 73, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 2],

// Baojun (brand_id: 74)
            ['model_name' => '530', 'brand_id' => 74, 'made_year_from' => 2017, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'E300', 'brand_id' => 74, 'made_year_from' => 2020, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'RC-6', 'brand_id' => 74, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 2],

// Scania (brand_id: 75)
            ['model_name' => 'R-series', 'brand_id' => 75, 'made_year_from' => 2004, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'S-series', 'brand_id' => 75, 'made_year_from' => 2016, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'P-series', 'brand_id' => 75, 'made_year_from' => 2004, 'made_year_to' => 2024, 'seat_count_id' => 1],

// MAN (brand_id: 76)
            ['model_name' => 'TGX', 'brand_id' => 76, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'TGS', 'brand_id' => 76, 'made_year_from' => 2007, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'TGL', 'brand_id' => 76, 'made_year_from' => 2005, 'made_year_to' => 2024, 'seat_count_id' => 1],

// Iveco (brand_id: 77)
            ['model_name' => 'Daily', 'brand_id' => 77, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'Eurocargo', 'brand_id' => 77, 'made_year_from' => 2000, 'made_year_to' => 2024, 'seat_count_id' => 1],
            ['model_name' => 'S-Way', 'brand_id' => 77, 'made_year_from' => 2019, 'made_year_to' => 2024, 'seat_count_id' => 1],

// Foton (brand_id: 78)
            ['model_name' => 'Tunland', 'brand_id' => 78, 'made_year_from' => 2011, 'made_year_to' => 2024, 'seat_count_id' => 2],
            ['model_name' => 'Sauvana', 'brand_id' => 78, 'made_year_from' => 2015, 'made_year_to' => 2024, 'seat_count_id' => 3],
            ['model_name' => 'Aumark', 'brand_id' => 78, 'made_year_from' => 2003, 'made_year_to' => 2024, 'seat_count_id' => 1],
        ];
        foreach ($carModels as $model) {
            CarModel::create($model);
        }
    }
}
