<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Accessory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    public function index()
    {
        $accessories = Accessory::with(['discount'])->get();

        return view('front.accessories', compact('accessories'));
    }

    public function accessoryDetails(Accessory $accessory)
    {
        return view('front.accessory_details', compact('accessory'));
    }


    public function search(Request $request)
    {
        // احفظ القيم في الجلسة
        session([
            'search' => $request->input('search'), // حفظ قيمة البحث في الجلسة
        ]);

        $query = $request->input('search');

        // البحث في المنتجات
        $accessories = Accessory::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(get_pagination_count())
            ->appends(['search' => $query]);;

        // عرض النتائج في عرض مخصص
        return view('front.search-results', compact('accessories', 'query'));
    }

    public function filterAccessories(Request $request, $category_id = null)
    {

        // احفظ القيم في الجلسة
        session([
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'sort_by' => $request->input('sort_by'),
            'search' => $request->input('search'), // حفظ قيمة البحث في الجلسة

        ]);

        $query = Accessory::query();


        // فلترة المنتجات بناءً على القسم الحالي
        if ($category_id) {
            $query->whereHas('categories', function ($q) use ($category_id) {
                $q->where('category_id', $category_id);
            });
        }
        // تحقق من وجود قيمة في حقل البحث
        if (session()->has('search') && session('search') !== '') {
            $query->where('name', 'like', '%' . session('search') . '%')
                ->orWhere('description', 'LIKE', "%" . session('search') . "%");
        }


        // استرجاع المنتجات
        $accessories = $query->get();

        // تطبيق الفلترة بعد استرجاع المنتجات بناءً على السعر المخصوم
        if ($request->filled('min_price')) {
            $accessories = $accessories->filter(function ($accessory) use ($request) {
                return $accessory->discounted_price >= $request->min_price;
            });
        }

        if ($request->filled('max_price')) {
            $accessories = $accessories->filter(function ($accessory) use ($request) {
                return $accessory->discounted_price <= $request->max_price;
            });
        }

        // تطبيق الترتيب بناءً على اختيار المستخدم
        switch ($request->sort_by) {
            // الفرز هنا سيتم من خلال الاكسيسورز وليس قيمة مباشرة في الداتابيز
            case 'price-asc':
                $accessories = $accessories->sortBy('discounted_price'); // فرز حسب السعر المخصوم تصاعديًا
                break;
            case 'price-desc':
                $accessories = $accessories->sortByDesc('discounted_price'); // فرز حسب السعر المخصوم تنازليًا
                break;
            case 'latest':
                $accessories = $accessories->sortByDesc('created_at'); // فرز حسب أحدث المنتجات
                break;
            default:
                $accessories = $accessories->sortBy('id'); // الفرز الافتراضي
                break;
        }

        $filteredAccessories = paginateProducts($accessories);

        // الاحتفاظ بالنتائج واستخدام redirect()->back()
        return redirect()->back()->with('filteredAccessories', $filteredAccessories);
    }
}
