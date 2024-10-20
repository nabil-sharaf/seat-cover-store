<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BagOption;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class BagOptionController extends Controller
{
    public function index()
    {
        $bags = BagOption::with('seatCover')->paginate(get_pagination_count());
        return view('admin.bag-options.index',compact('bags'));
    }

    public function create()
    {
        $seatCovers =Category::all();
        return view('admin.bag-options.create',compact('seatCovers'));
    }

    public function store(Request $request)
    {
        $request->validate([
                'category_id' => 'required|exists:categories,id|unique:bag_options,category_id,category_id',
                'bag_price' => 'required|numeric|min:0',
            ],[
                'category_id.unique'=>'يوجد سعر مسجل مسبقا لهذا النوع  يمكنك الذهاب إليه وتعديله ',
                'bag_price.required'=>'ادخل سعر الشنطة',
                'bag_price.numeric' => '  السعر يجب ان يكون ارقام فقط',
                'bag_price.min' => '  ادخل سعر صحيح للشنطة او صفر لجعل سعر الشنطة مجاني',

            ]
        );
        $data = $request->all();

        BagOption::create($data);
        return redirect()->route('admin.bag-options.index')->with('success', 'تمت الإضافة بنجاح.');

    }


    public function edit(BagOption $bagOption)
    {
        return view('admin.bag-options.edit',compact('bagOption'));
    }
    public function update(Request $request,BagOption $bagOption)
    {
        $request->validate([
                'bag_price' => 'required|numeric|min:0',
            ],[
                'bag_price.required'=>'ادخل سعر الشنطة',
                'bag_price.numeric' => '  السعر يجب ان يكون ارقام فقط',
                'bag_price.min' => '  ادخل سعر صحيح للشنطة او صفر لجعل سعر الشنطة مجاني',

            ]
        );

        $bagOption->update([
            'bag_price'=>$request->bag_price,
        ]);
        return redirect()->route('admin.bag-options.index')->with('success', 'تم التحديث بنجاح.');

    }

    public function destroy(BagOption $bagOption)
    {
        $bagOption->delete();
        return redirect()->route('admin.bag-options.index')->with('error','تم حذف سعر الشنطة بنجاح');
    }
}
