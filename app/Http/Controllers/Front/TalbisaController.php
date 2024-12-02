<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Accessory;
use App\Models\Admin\CarBrand;
use App\Models\Admin\Category;
use App\Models\Admin\SeatCount;
use App\Models\Admin\ShippingRate;
use App\Models\User;

class TalbisaController extends Controller
{
    public function index()
    {
        $category = Category::where('id',4)->first();
        $seatCounts = SeatCount::all();
        $car_brands = CarBrand::all();
        $colors = $category->coverColors;
        return view('front.talbisa',
            compact('category', 'seatCounts', 'car_brands','colors')
        );
    }
}
