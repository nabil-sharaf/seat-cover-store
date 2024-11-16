<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index',compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }


    public function store(SliderRequest $request)
    {

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $randomName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('sliders',$randomName ,'public');
        }

        Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'تمت إضافة السلايدر بنجاح');
    }



    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $slider = Slider::findOrfail($id);
        return view('admin.sliders.edit',compact('slider'));
    }


    public function update(SliderRequest $request, Slider $slider)
    {
        $data = $request->validated();

        // التعامل مع الصورة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }

            // تخزين الصورة الجديدة
            $image = $request->file('image');
            $randomName = uniqid() . '.' . $image->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('sliders', $randomName, 'public');
        }

        // تحديث بيانات السلايدر
        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', 'تم تحديث السلايدر بنجاح');
    }

    public function destroy(Slider $slider)
    {
        try {
            // حذف الصورة من التخزين إذا كانت موجودة
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }

            // حذف السلايدر
            $slider->delete();

            return redirect()->route('admin.sliders.index')->with('success','ـم حذف السلايدر بنجاح');

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ أثناء حذف السلايدر'
            ]);
        }
    }
}
