<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Admin\UserAddress;
use Illuminate\Http\Request;
use App\Models\User;
class CustomerController extends Controller
{

    public function index()
    {
        $users = User::paginate(get_pagination_count());
        return view('admin.customers.index',compact('users'));
    }

    public function show(User $user)
    {
        $totalSpending = $user->orders?->sum('total_after_discount'); // مثال لحساب الانفاق الكلي
        $lastMonthSpending = $user->orders?->whereMonth('created_at', now()->subMonth()->month)->sum('total_after_discount'); // مثال لحساب انفاق آخر شهر

        return view('admin.customers.show', compact('user','totalSpending','lastMonthSpending'));

    }

    public function update(CustomerRequest $request ,User $user)
    {
       $updated= $user->update([
            'customer_type'=>$request->customer_type,
            'name'=>$request->name,
            'status'=>$request->status,
        ]);

       if($updated){
         return response()->json([
             'success'=>'تم تحديث البيانات بنجاح',
             'userType'=>$user->customer_type,
             'userName'=>$user->name,
             'status'=>$user->status,
         ]);
       }else{
           return response()->json(['error'=>'حدث خطأ اثناء التعديل حاول مرة اخرى']);

       }
    }

    public function changeStatus(User $user)
    {
        // تبديل حالة المستخدم من 0 إلى 1 أو من 1 إلى 0
        $user->status = $user->status ? 0 : 1;
        $user->save();

        // إعادة الاستجابة بالنجاح
        return response()->json([
            'message' => $user->status ? 'تم تفعيل المستخدم بنجاح' : 'تم تعطيل المستخدم بنجاح',
            'is_active' => $user->status,
        ]);
    }

    public function getUserAddress($id)
    {
        // جلب العنوان للمستخدم بناءً على الـ id
        $address = UserAddress::where('user_id', $id)->first();

        if ($address) {
            return response()->json([
                'success' => true,
                'address' => $address
            ]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}

