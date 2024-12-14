<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin\Order;
use App\Models\Admin\ShippingRate;
use App\Models\Front\UserAddress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $id = \auth()->user()->id;
        $states = ShippingRate::get();
        $address = UserAddress::where('user_id',$id)->first();
        $orders = Order::where('user_id',$id)->get();
        return \view('front.profile',compact('address','orders','states'));
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        // تحديث بيانات المستخدم
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');

        // تحديث كلمة المرور إذا تم إدخال كلمة مرور جديدة
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        $user->save();

        return redirect()->back()->with('success', __('profile.update_success'));
    }
    /**
     * Delete the user's account.
     */
    public function updateAddress(Request $request)
    {
        // تخصيص رسائل التحقق بالعربية
        $messages = [
            'address.required' => 'حقل العنوان مطلوب',
            'address.string' => 'يجب أن يكون العنوان نصاً',
            'address.max' => 'يجب ألا يتجاوز العنوان 255 حرفاً',

            'city.required' => 'حقل المدينة مطلوب',
            'city.string' => 'يجب أن تكون المدينة نصاً',
            'city.max' => 'يجب ألا يتجاوز اسم المدينة 255 حرفاً',

            'state.required' => 'حقل المنطقة مطلوب',
            'state.string' => 'يجب أن تكون المنطقة نصاً',
            'state.max' => 'يجب ألا يتجاوز اسم المنطقة 255 حرفاً',

            'full_name.required' => 'حقل الاسم الكامل مطلوب',
            'full_name.string' => 'يجب أن يكون الاسم نصاً',
            'full_name.max' => 'يجب ألا يتجاوز الاسم 255 حرفاً',

            'phone.required' => 'حقل رقم الجوال مطلوب',
            'phone.string' => 'يجب أن يكون رقم الجوال نصاً',
            'phone.min' => 'يجب ألا يقل رقم الجوال عن 9 أرقام',
            'phone.max' => 'يجب ألا يتجاوز رقم الجوال 15 رقماً',
            'phone.regex' => 'يجب إدخال رقم جوال سعودي صحيح'
        ];

        // قم بإجراء التحقق من صحة البيانات مع إضافة الرسائل المخصصة
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'phone' => ['required', 'string',
                'min:9',
                'max:15',
                'regex:/^(\+?9665|9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/'],
        ], $messages);

        // إذا كانت البيانات غير صحيحة، قم بإعادة التوجيه مع الأخطاء
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator, 'addressErrors');
        }
        // احصل على المستخدم الحالي
        $user = auth()->user();

        // حاول الحصول على العنوان الحالي للمستخدم
        $address = $user->address; // نفترض أن العلاقة بين المستخدم والعنوان هي address

        if ($address) {
            // إذا كان العنوان موجودًا، قم بتحديثه
            $address->update([
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'full_name'=>$request->full_name,
                'phone'=>$request->phone,

            ]);
        } else {
            // إذا لم يكن العنوان موجودًا، قم بإنشائه
            $user->address()->create([
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'full_name'=>$request->full_name,
                'phone'=>$request->phone
            ]);
        }

        // قم بإعادة التوجيه مع رسالة النجاح
        return redirect()->back()->with('success', __('profile.address_updated'));
    }
}
