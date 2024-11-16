<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Models\Admin\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::paginate(get_pagination_count());
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.update');
    }

    public function store(BranchRequest $request)
    {


        Branch::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'map' => $request->map,
//
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'تم اضافة الفرع  بنجاح');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.update', compact('branch'));
    }

    public function update(BranchRequest $request, Branch $branch)
    {

        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'map' => $request->map,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'تم تحديث التقييم بنجاح');
    }

    public function destroy(Branch $branch)
    {

        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'تم حذف التقييم بنجاح');
    }
}
