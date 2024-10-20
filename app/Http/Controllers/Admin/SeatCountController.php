<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\SeatCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeatCountController extends Controller
{
    public function index()
    {
        $seatCounts = SeatCount::paginate(get_pagination_count());
        return view('admin.seat_counts.index', compact('seatCounts'));
    }

    public function create()
    {
        $seatCovers = Category::all(); // لجلب seat covers
        return view('admin.seat_counts.create', compact('seatCovers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // تحقق من الصورة
        ]
        );

        $data = $request->all();

        // إذا تم رفع صورة، قم بتخزينها
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('seats', 'public');
            $data['image'] = $imagePath;
        }

        SeatCount::create($data);
        return redirect()->route('admin.seat-counts.index')->with('success', 'تمت الإضافة بنجاح.');
    }

    public function edit(SeatCount $seatCount)
    {
        $seatCovers = Category::all();
        return view('admin.seat_counts.edit', compact('seatCount', 'seatCovers'));
    }

    public function update(Request $request, SeatCount $seatCount)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // تحقق من الصورة

         ]);

        $data = $request->all();

        // إذا تم رفع صورة جديدة، قم بتخزينها
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('seats', 'public'); // تخزين الصورة في مجلد public/seat_counts
            $data['image'] = $imagePath;
        }

        $seatCount->update($data);
        return redirect()->route('admin.seat-counts.index')->with('success', 'تم التعديل بنجاح.');
    }

    public function destroy(SeatCount $seatCount)
    {
        if ($seatCount->image) {
            // مسح الصورة من السيرفر
            Storage::disk('public')->delete($seatCount->image);
        }
        $seatCount->delete();
        return redirect()->route('admin.seat-counts.index')->with('success', 'تم الحذف بنجاح.');
    }
}
