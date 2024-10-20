<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    public function index(){

        $brands = CarBrand::paginate(get_pagination_count());

        // عرض صفحة الفهرس مع تمرير البراندات
        return view('admin.car_brands.index', compact('brands'));
    }

    // عرض نموذج إضافة براند جديد
    public function create()
    {
        return view('admin.car_brands.add');
    }

    // تخزين البراند الجديد
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'brand_name' => 'required|string|max:255|unique:car_brands',
        ]);

        // إنشاء البراند
        CarBrand::create([
            'brand_name' => $request->brand_name,
        ]);

        // إعادة التوجيه بعد الإضافة
        return redirect()->route('admin.car-brands.index')->with('success', 'تم إضافة البراند بنجاح.');
    }

    // عرض صفحة تعديل البراند
    public function edit($id)
    {
        $brand = CarBrand::findOrFail($id);
        return view('admin.car_brands.edit', compact('brand'));
    }

    // تحديث بيانات البراند
    public function update(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'brand_name' => 'required|string|max:255|unique:car_brands,brand_name,'.$id,
        ]);

        // تحديث بيانات البراند
        $brand = CarBrand::findOrFail($id);
        $brand->update([
            'brand_name' => $request->brand_name,
        ]);

        // إعادة التوجيه بعد التعديل
        return redirect()->route('admin.car-brands.index')->with('success', 'تم تعديل البراند بنجاح.');
    }

    // حذف البراند
    public function destroy($id)
    {
        $brand = CarBrand::findOrFail($id);
        $brand->delete();

        // إعادة التوجيه بعد الحذف
        return redirect()->route('admin.car-brands.index')->with('success', 'تم حذف البراند بنجاح.');
    }
}
