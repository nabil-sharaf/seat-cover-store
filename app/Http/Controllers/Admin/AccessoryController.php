<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccessoryRequest;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin\Accessory;
use App\Models\Admin\AccessoryDiscount;
use App\Models\Admin\Category;
use App\Models\Admin\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AccessoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Accessory::query();

        // تحقق من وجود البحث
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // إضافة العلاقات المطلوبة مثل الفئات والخصومات
        $accessories = $query->paginate(get_pagination_count());

        return view('admin.accessories.index', compact('accessories'));
    }

    public function create()
    {
        $categories = Category::where('product_type', 'accessory')->get();
        return view('admin.accessories.add', compact('categories'));
    }

    public function store(AccessoryRequest $request)
    {

        try {
            // بدء الترانزكشن
            DB::beginTransaction();

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];
                foreach ($images as $image) {
                    $randomName = uniqid() . '.' . $image->getClientOriginalExtension();
                    // تخزين الصورة في المسار المحدد
                    $path = $image->storeAs('accessories', $randomName, 'public');

                    $imagePaths[] = $path;

                }
            } else {
                $imagePaths = null;
            }


            // إنشاء المنتج
           $accessory= Accessory::create([
                'name' => $request->name,
                'description' => $request->description,
                'images' => $imagePaths,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'quantity'=>$request->quantity

            ]);

            if($request->discount_type && $request->discount_value > 0){

               AccessoryDiscount::create([
                    'accessory_id' => $accessory->id,
                    'discount_value' => $request->discount_value,
                    'discount_type' => $request->discount_type,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
            }

            // تأكيد الترانزكشن
            DB::commit();

            return redirect()->route('admin.accessories.index')->with('success', 'تم اضافة المنتج بنجاح');


        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', $e->validator->errors());

        }
    }

    public function show($id)
    {
        $accessory = Accessory::findOrFail($id);
        return view('admin.accessories.show', compact('accessory'));
    }

    public function edit(Accessory $accessory)
    {
        $categories = Category::where('product_type', 'accessory')->get();
        return view('admin.accessories.edit', compact('accessory', 'categories'));
    }

    public function update(AccessoryRequest $request, Accessory $accessory)
    {

        try {
            if ($request->hasFile('images')) {
                $oldImages = $accessory->images;
                if (!empty($oldImages)) {
                    foreach ($oldImages as $oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }

                $images = $request->images;
                $imagesPaths=[];
                foreach ($images as $image) {
                    $randomName = uniqid() . '.' . $image->getClientOriginalExtension();

                    // تخزين الصورة في المسار المحدد
                    $path = $image->storeAs('accessories', $randomName, 'public');
                    $imagesPaths[]=$path;
                }

                $accessory->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'images' => $imagesPaths,
                    'category_id' => $request->category_id,
                    'price'=>$request->price,
                    'quantity'=>$request->quantity
                ]);
            } else {
                $accessory->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'category_id' => $request->category_id,
                    'price'=>$request->price,
                    'quantity'=>$request->quantity
                ]);
            }

            if($request->discount_type && $request->discount_value > 0){

                AccessoryDiscount::updateOrCreate(
                   // الشرط لتحديد إذا كان الريكورد موجودًا
                    ['accessory_id' => $accessory->id]
                    ,[
                    'discount_value' => $request->discount_value,
                    'discount_type' => $request->discount_type,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
            }else{
                // البحث عن الريكورد الذي يحتوي على المنتج المحدد
                $accessoryDiscount = AccessoryDiscount::where('accessory_id', $accessory->id)->first();

                // التحقق من وجود الريكورد ثم حذفه
                if ($accessoryDiscount) {
                    $accessoryDiscount->delete();
                }
            }


            return redirect()->route('admin.accessories.index')->with('success', 'تم تحديث المنتج بنجاح');
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->with('errors',$e->validator->errors());
        }
    }

    public function destroy(Accessory $accessory)
    {
        $this->deleteProductImages($accessory);
        $accessory->delete();

        return response()->json(['success' => 'تم حذف المنتج بنجاح']);
    }
    private function deleteProductImages(Accessory $accessory)
    {
        if ($accessory->images != null) {
            foreach ($accessory->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
    }

    public function deleteImage(Request $request, $id)
    {
        $accessory = Accessory::findOrFail($id);
        $images = json_decode($accessory->images, true);

        if (isset($images[$request->imageIndex])) {
            // حذف الصورة من الملفات إذا لزم الأمر
            Storage::delete('public/' . $images[$request->imageIndex]);

            // حذف الصورة من القائمة
            unset($images[$request->imageIndex]);
            $accessory->images = json_encode(array_values($images)); // إعادة الترتيب
            $accessory->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

}
