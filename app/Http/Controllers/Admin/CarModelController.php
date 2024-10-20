<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CarBrand;
use App\Models\Admin\CarModel;
use App\Models\Admin\SeatCount;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    // عرض كل الموديلات
    public function index()
    {
        $carModels = CarModel::with('brand')->paginate(get_pagination_count()); // إحضار البراند مع الموديلات
        return view('admin.car_models.index', compact('carModels'));
    }

    // عرض نموذج إضافة موديل جديد
    public function create()
    {
        $brands = CarBrand::all(); // إحضار جميع البراندات
        $seatCounts = SeatCount::all();
        return view('admin.car_models.create', compact('brands','seatCounts'));
    }

    // حفظ الموديل الجديد
    public function store(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string|max:255',
            'made_year_from' => 'required|integer|min:2000|max:' . now()->year,
            'made_year_to' => 'required|integer|min:2000|max:' . now()->year . '|gte:made_year_from',
            'brand_id' => 'required|exists:car_brands,id', // التأكد من وجود brand_id في جدول البراندات
            'seat_count_id'=>'required|exists:seat_counts,id',
        ], [
            'made_year_from.min' => 'أقل سنة متاحة هي 2000.',
            'made_year_from.max' => 'أعلى سنة متاحة هي السنة الحالية.',

            'made_year_to.min' => 'أقل سنة متاحة هي 2000.',
            'made_year_to.max' => 'أعلى سنة متاحة هي السنة الحالية.',
            'made_year_to.gte' => 'سنة نهاية التصنيع يجب أن تكون أكبر أو تساوي سنة بداية التصنيع.',
            'seat_count_id.required'=>'لابد من اختيار عدد المقاعد'
            ]);

        CarModel::create($request->all());

        return redirect()->route('admin.car-models.index')->with('success', 'تم إضافة الموديل بنجاح.');
    }

    // عرض صفحة تعديل الموديل
    public function edit($id)
    {
        $carModel = CarModel::findOrFail($id);
        $brands = CarBrand::all(); // إحضار جميع البراندات
        $seatCounts = SeatCount::all();
        return view('admin.car_models.edit', compact('carModel', 'brands','seatCounts'));
    }

    // تحديث بيانات الموديل
    public function update(Request $request, $id)
    {
        $request->validate([
            'model_name' => 'required|string|max:255',
            'made_year_from' => 'required|integer|min:2000|max:' . now()->year,
            'made_year_to' => 'required|integer|min:2000|max:' . now()->year . '|gte:made_year_from',
            'brand_id' => 'required|exists:car_brands,id', // التأكد من وجود brand_id في جدول البراندات
            'seat_count_id'=>'required|exists:seat_counts,id',
        ], [
            'made_year_from.min' => 'أقل سنة متاحة هي 2000.',
            'made_year_from.max' => 'أعلى سنة متاحة هي السنة الحالية.',

            'made_year_to.min' => 'أقل سنة متاحة هي 2000.',
            'made_year_to.max' => 'أعلى سنة متاحة هي السنة الحالية.',
            'made_year_to.gte' => 'سنة نهاية التصنيع يجب أن تكون أكبر أو تساوي سنة بداية التصنيع.',
            'seat_count_id.required'=>'لابد من اختيار عدد المقاعد'
        ]);

        $carModel = CarModel::findOrFail($id);
        $carModel->update($request->all());

        return redirect()->route('admin.car-models.index')->with('success', 'تم تحديث الموديل بنجاح.');
    }

    // حذف الموديل
    public function destroy($id)
    {
        $carModel = CarModel::findOrFail($id);
        $carModel->delete();

        return redirect()->route('admin.car-models.index')->with('success', 'تم حذف الموديل بنجاح.');
    }
}
