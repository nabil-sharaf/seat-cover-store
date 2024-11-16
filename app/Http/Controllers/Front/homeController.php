<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Accessory;
use App\Models\Admin\Branch;
use App\Models\Admin\Category;
use App\Models\Admin\Popup;
use App\Models\Admin\Setting;
use App\Models\Admin\SiteImage;
use App\Models\Admin\Slider;
use App\Models\Admin\Testimonial;

class homeController extends Controller
{
    public function index()
    {

        $categories = Category::with('accessories')->get();

        $sliders = Slider::all();
        $testimonials = Testimonial::all();
        return view('front.index', compact('categories','testimonials', 'sliders'));
    }

    public function accessoryDetails($id)
    {
        $accessory = Accessory::find($id);

        if (!$accessory) {
            return response()->json(['message' => 'accessory not found'], 404);
        }

        return response()->json([
            'name' => $accessory->name,
            'discounted_price' => $accessory->discounted_price,
            'price' => $accessory->accessory_price,
            'description' => $accessory->description,
            'info' => $accessory->info,
            'images' => $accessory->images,
            'categories' => $accessory->categories
        ]);
    }

    public function aboutUs()
    {
        $testimonials = Testimonial::all();
        return view('front.about', compact( 'testimonials'));
    }
    public function branches()
    {
        $branches = Branch::all();
        return view('front.branches', compact( 'branches'));
    }

    public function categoryProducts($id)
    {
        $category = Category::where('id', $id)->first();
        $categories = Category::where("parent_id", $id)->get();
        $type = $category->product_type;
        if ($type == 'accessory') {
            $accessories = Accessory::where('category_id', $id)->get();
            return view('front.accessories', compact('accessories'));
        } elseif ($type == 'earth') {
            return view('front.talbisat_earth', compact('categories'));
        } else {
            return view('front.talbisat_seats', compact('categories'));
        }

    }
}
