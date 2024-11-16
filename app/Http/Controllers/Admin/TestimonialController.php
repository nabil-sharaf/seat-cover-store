<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Admin\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::paginate(get_pagination_count());
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.update');
    }

    public function store(TestimonialRequest $request)
    {


//        $imagePath = null;
//        if ($request->hasFile('client_image')) {
//            $imagePath = $request->file('client_image')->store('testimonials', 'public');
//        }

        Testimonial::create([
            'client_name' => $request->client_name,
            'testimonial' => $request->testimonial,
//            'client_image' => $imagePath,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'تم إضافة التقييم بنجاح');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.update', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
//        $imagePath = $testimonial->client_image;
//        if ($request->hasFile('client_image')) {
            // حذف الصورة القديمة إذا كانت موجودة
//            if ($imagePath) {
//                Storage::disk('public')->delete($imagePath);
//            }
//            $imagePath = $request->file('client_image')->store('testimonials', 'public');
//        }

        $testimonial->update([
            'client_name' => $request->client_name,
            'testimonial' => $request->testimonial,
//            'client_image' => $imagePath,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'تم تحديث التقييم بنجاح');
    }

    public function destroy(Testimonial $testimonial)
    {
//        if ($testimonial->client_image) {
//            Storage::disk('public')->delete($testimonial->client_image);
//        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'تم حذف التقييم بنجاح');
    }
}
