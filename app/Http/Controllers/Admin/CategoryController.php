<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Admin\Accessory;
use App\Models\Admin\BagOption;
use App\Models\Admin\CarBrand;
use App\Models\Admin\CarModel;
use App\Models\Admin\Category;
use App\Models\Admin\CoverColor;
use App\Models\Admin\SeatPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nette\Schema\ValidationException;
use function redirect;
use function view;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('checkRole:superAdmin', only: ['destroy']),
        ];
    }

    public function index()
    {
        $categories = Category::paginate(get_pagination_count());
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.add', compact('categories'));

    }

    public function store(CategoryRequest $request)
    {
        try {

            if($request->hasFile('image')){

                $extension = $request->file('image')->getClientOriginalExtension();

                // إنشاء اسم جديد للصورة مع ضمان أن يكون فريدًا
                $imageName = time() . '_' . uniqid() . '.' . $extension;

                // رفع الصورة مع الاسم الجديد إلى مجلد categories
                $imagePath = $request->file('image')->storeAs('categories', $imageName, 'public');

            }else{
                $imagePath = null;
            }
                // الحصول على امتداد الصورة

            // إنشاء الكاتيجوري مع الصورة
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'image' => $imagePath, // تخزين مسار الصورة
                'product_type'=>$request->product_type,
            ]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'تم إنشاء الكاتيجوري بنجاح');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function show(Category $category)
{
    $category->load('children', 'parent');
    $breadcrumbs = $this->getBreadcrumbs($category);
    return view('admin.categories.show', compact('category', 'breadcrumbs'));
}

    private function getBreadcrumbs(Category $category)
{
    $breadcrumbs = collect([$category]);
    $parent = $category->parent;
    while($parent) {
        $breadcrumbs->prepend($parent);
        $parent = $parent->parent;
    }
    return $breadcrumbs;
}


    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->whereNull('parent_id')->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            // التحقق مما إذا كانت هناك صورة جديدة
            if ($request->hasFile('image')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($category->image && Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }

                // رفع الصورة الجديدة
                $extension = $request->file('image')->getClientOriginalExtension();
                $imageName = time() . '_' . uniqid() . '.' . $extension;
                $imagePath = $request->file('image')->storeAs('categories', $imageName, 'public');

                // تحديث باقي البيانات
                $category->update([
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'parent_id'=>$request->parent_id,
                    'image'=>$imagePath,
                    'product_type'=>$request->product_type,
                ]);
            }else{
                // تحديث باقي البيانات
                $category->update([
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'parent_id'=>$request->parent_id,
                    'product_type'=>$request->product_type,

                ]);
            }



            return redirect()->route('admin.categories.index')
                ->with('success', 'تم تحديث الكاتيجوري بنجاح');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function destroy(Category $category)
    {
        try {
            // التحقق مما إذا كانت الصورة موجودة
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                // حذف الصورة من السيرفر
                Storage::disk('public')->delete($category->image);
            }

            // حذف القسم
            $category->delete();

            return redirect()->route('admin.categories.index')
                ->with('success', 'تم حذف الكاتيجوري بنجاح');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء محاولة حذف الكاتيجوري');
        }
    }

    public function getProductsByCategory($type)
    {
        if ($type == 'accessory') {
            $products = Accessory::all();
        } elseif ($type == 'earth') {
            $products = Category::whereNotNull('parent_id')->where('product_type','earth')->get();
        } else {
            $products = Category::whereNotNull('parent_id')->where('product_type','seat')->get();
        }
        return response()->json($products);
    }


    public function getColors($CoverId)
    {
        // افترض أن جدول الألوان يحتوي على حقل seat_cover_id لربطه بالتلبيسة
        $colors = CoverColor::where('category_id', $CoverId)->get();

        // ارجع الألوان كـ JSON
        return response()->json($colors);
    }

    public function getBrandsBySeatCount($seatCountId)
    {
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
            ->where('seat_count_id',$seatCountId)->get();

        // ارجع الموديلات كـ JSON
        return response()->json($models);
    }

    public function coverPriceChange(Request $request)
    {
        $coverId = $request->input('cover_id');
        $countId = $request->input('seat_count_id');

        $price = SeatPrice::where('category_id', $coverId)
            ->where('seat_count_id',$countId)->first();

        $bag_price = BagOption::where('category_id',$coverId)->first();

        // ارجع السعر كـ JSON
        return response()->json(['bag_price'=>$bag_price,'cover_price'=>$price]);
    }

    public function getMadeYears(Request $request)
    {
        $modelId= $request->input('model_id');

        $years = CarModel::where('id', $modelId)->first();
        if($years){
            $data = $years->made_year_from .'-'.$years->made_year_to;
        }else{
            $data = null;
        }

        // ارجع السعر كـ JSON
        return response()->json($data);
    }

    public function accessoryPriceChange(Request $request)
    {
        $id = $request->input('accessory_id');

        $price = Accessory::where('id',$id)->first()->discounted_price;

        // ارجع السعر كـ JSON
        return response()->json([$price]);
    }


}
