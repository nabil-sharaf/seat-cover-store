<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\SeatCount;
use App\Models\Admin\SeatPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeatPriceController extends Controller
{
    public function index()
    {
        $seatPrices = SeatPrice::paginate(get_pagination_count());
        return view('admin.seat_prices.index', compact('seatPrices'));
    }

    public function create()
    {
        $seatCovers = Category::whereIn('product_type',['earth','seat'])->whereNotNull('parent_id')->get(); // لجلب seat covers
        $seatCounts = SeatCount::all();
        return view('admin.seat_prices.create', compact('seatCovers','seatCounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
                'category_id' => 'required|exists:categories,id',
                'seat_count_id' => 'required|exists:seat_counts,id',
                'price' => 'required|numeric|min:0',
            ]
        );

        $seat = SeatPrice::where('category_id',$request->category_id)->where('seat_count_id',$request->seat_count_id)->first();
        if($seat ){
            return redirect()->back()->with(['error' => 'سعر هذا النوع موجود من قبل',
            ]);
        }
        $data = $request->all();

        SeatPrice::create($data);
        return redirect()->route('admin.seat-prices.index')->with('success', 'تمت الإضافة بنجاح.');
    }

    public function edit(SeatPrice $seatPrice)
    {
        $seatCovers = Category::whereIn('product_type',['earth','seat'])->whereNotNull('parent_id')->get(); // لجلب seat covers
        $seatCounts = SeatCount::all();
        return view('admin.seat_prices.edit', compact('seatPrice', 'seatCovers','seatCounts'));
    }

    public function update(Request $request, SeatPrice $seatPrice)
    {
        // Validation rules
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'seat_count_id' => 'required|exists:seat_counts,id',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if there is already a record with the same category_id and seat_count_id but not the current one
        $seat = SeatPrice::where('category_id', $request->category_id)
            ->where('seat_count_id', $request->seat_count_id)
            ->where('id', '!=', $seatPrice->id) // Exclude the current record from the check
            ->get();

        if ($seat->count() > 0) {
            // If a duplicate record exists, return with an error
            return redirect()->back()->with(['error' => 'سعر هذا النوع موجود من قبل']);
        }

        // Update the seat price with the validated data
        $seatPrice->update($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('admin.seat-prices.index')->with('success', 'تم التعديل بنجاح.');
    }

    public function destroy(SeatPrice $seatPrice)
    {
        $seatPrice->delete();
        return redirect()->route('admin.seat-prices.index')->with('success', 'تم الحذف بنجاح.');
    }
}
