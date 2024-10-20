<?php

namespace Database\Seeders;

use App\Models\Admin\CarBrand;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminsTableSeeder::class,
            UsersTableSeeder::class,
            StatusesTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            SettingsTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            ShippingRateSeeder::class,
            SeatCountTableSeeder::class,
            CarBrandsSeeder::class,
            CarModelsSeeder::class,
        ]);
    }
}
