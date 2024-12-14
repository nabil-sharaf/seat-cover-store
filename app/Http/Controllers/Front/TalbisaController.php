<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Accessory;
use App\Models\Admin\BagOption;
use App\Models\Admin\CarBrand;
use App\Models\Admin\CarModel;
use App\Models\Admin\Category;
use App\Models\Admin\SeatCount;
use App\Models\Admin\ShippingRate;
use App\Models\User;
use Illuminate\Http\Request;

class TalbisaController extends Controller
{
    public function index($id)
    {
        // جلب الكاتيجوري بناءً على الـ ID
        $category = Category::find($id);

        // التحقق من وجود الكاتيجوري
        if (!$category) {
            abort(404); // إذا لم يتم العثور عليه، يتم عرض صفحة خطأ 404
        }

        // التحقق من نوع المنتج
        if ($category->product_type === 'accessory') {
            return redirect()->route('accessories.index');
        }
        // التحقق من نوع المنتج
        if ($category->product_type !== 'accessory' && $category->parent_id !== null) {
            // جلب البيانات الأخرى إذا لم يكن نوع المنتج إكسسوار
            $seatCounts = SeatCount::all();
            $car_brands = CarBrand::all();
            $colors = $category->coverColors;

            return view('front.talbisa', compact('category', 'seatCounts', 'car_brands', 'colors'));
        }
        return redirect()->route('home.index');
    }

    public function getBrandsBySeatCount(Request $request)
    {
        $seatCountId = $request->input('seat_count_id');
        // استعلام لجلب البراندات التي تحتوي على موديلات بنفس عدد المقاعد
        $brands = CarBrand::whereHas('carModels', function ($query) use ($seatCountId) {
            $query->where('seat_count_id', $seatCountId);
        })->get();

        return response()->json($brands);
    }

    public function getModels(Request $request)
    {
        $brandId = $request->input('brand_id');
        $seatCountId = $request->input('seat_count_id');
        // جلب الموديلات المرتبطة ببراند معين
        $models = CarModel::where('brand_id', $brandId)
            ->where('seat_count_id', $seatCountId)->get();

        // ارجع الموديلات كـ JSON
        return response()->json($models);
    }

    public function getMadeYears(Request $request)
    {
        $modelId = $request->input('model_id');
        // جلب الموديلات المرتبطة ببراند معين
        $model = CarModel::where('id', $modelId)->first();

        // ارجع الموديلات كـ JSON
        return response()->json($model);
    }

    public function getBagPrice(Request $request)
    {
        $id = $request->input('category_id');
        // جلب الموديلات المرتبطة ببراند معين
        $price = BagOption::where('id', $id)->first()->bag_price;

        // ارجع الموديلات كـ JSON
        return response()->json($price);
    }

}
