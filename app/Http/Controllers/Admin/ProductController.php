<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin\Product;
use App\Models\Admin\Image;
use App\Models\Admin\Category;
use App\Models\Admin\ProductDiscount;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [

            new Middleware('checkRole:superAdmin', only: ['destroy','deleteAll']),
        ];
    }
    public function index(Request $request)
    {
        $query = Product::query();

        // تحقق من وجود البحث
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // إضافة العلاقات المطلوبة مثل الفئات والخصومات
        $products = $query->paginate(get_pagination_count());

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    public function store(ProductRequest $request)
    {

        try {

            if ($request->hasFile('image')) {
                $image = $request->image;
                $randomName = uniqid() . '.' . $image->getClientOriginalExtension();
                // تخزين الصورة في المسار المحدد
                $path = $image->storeAs('products', $randomName, 'public');
            }else{
                $path = null;
            }
            // إنشاء المنتج
          Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'image'=>$path,
                'category_id'=>$request->category_id,
                'tatriz_color'=>$request->tatriz_color,
                'status'=>'1',
            ]);


            return response()->json([
                'success' => 'تم إضافة المنتج بنجاح',
            ]);

        } catch (ValidationException $e) {
            // إرجاع الأخطاء كـ JSON
            return response()->json([
                'errors' => $e->validator->errors()
            ], 422); // كود 422 يعني أخطاء في الفاليديشان

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' =>'حدث خطأ أثناء اضافة المنتج تأكد من ملئ جميع الحقول والتواريخ بصورة صحيحة'], 500);
        }
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
                if ($request->hasFile('image')) {
                    $image = $request->image;
                    $randomName = uniqid() . '.' . $image->getClientOriginalExtension();
                    // تخزين الصورة في المسار المحدد
                    $path = $image->storeAs('products', $randomName, 'public');

                    $product->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'image'=>$path,
                        'category_id'=>$request->category_id,
                        'tatriz_color'=>$request->tatriz_color,
                        'status'=>$request->status,
                    ]);
                }else{
                    $product->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'category_id'=>$request->category_id,
                        'tatriz_color'=>$request->tatriz_color,
                        'status'=>$request->status,
                    ]);
                }

                return redirect()->route('admin.products.index')->with('success', 'تم تحديث المنتج بنجاح');
            ;
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        $this->deleteProductImages($product);
        $product->delete();

        return response()->json(['success' => 'تم حذف المنتج بنجاح']);
    }


    private function deleteProductImages(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
    }

    public function removeImage($id)
    {
        try {
            $image = Image::findOrFail($id);

            // تحقق من وجود الملف قبل محاولة حذفه
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            } else {
                Log::warning("File not found: {$image->path}");
            }

            $image->delete();

            return response()->json(['success' => true, 'message' => 'تم حذف الصورة بنجاح']);
        } catch (\Exception $e) {
            Log::error('Error deleting image: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء حذف الصورة: ' . $e->getMessage()], 500);
        }
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $products = Product::whereIn('id', $ids)->get();
        foreach ($products as $product) {

        $this->deleteProductImages($product);
        $product->delete();
        }

        return response()->json(['success' => 'تم حذف العناصر المختارة بنجاح']);
    }
    public function trendAll(Request $request)
    {
        $ids = $request->ids;
        $products = Product::whereIn('id', $ids)->get();
        foreach ($products as $product) {


       $product->update([
           'is_trend'=>true,
       ]);

        }

        return response()->json(['success' => 'تم جعل المنتجات المختارة ترند بنجاح']);
    }
    public function bestSellerAll(Request $request)
    {
        $ids = $request->ids;
        $products = Product::whereIn('id', $ids)->get();
        $allUpdated = true; // متغير للتحقق من نجاح التحديث لجميع المنتجات

        foreach ($products as $product) {

            $updated = $product->update([
                'is_best_seller' => true,
            ]);


            if (!$updated) {
                $allUpdated = false; // إذا فشل التحديث لأي منتج
                break; // إيقاف الحلقة إذا كان هناك فشل
            }
        }

        if ($allUpdated) {
            return response()->json(['success' => 'تم جعل المنتجات المحددة كالأفضل']);
        } else {
            return response()->json(['error' => 'حدث خطأ أثناء تحديث بعض المنتجات'], 500);
        }
    }


}

