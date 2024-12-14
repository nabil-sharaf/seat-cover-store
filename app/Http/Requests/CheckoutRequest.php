<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * تحديد إذا كان المستخدم مخول لعمل هذا الطلب.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // يمكن تغييرها للتحقق من صلاحيات المستخدم إذا لزم الأمر.
    }

    /**
     * تحديد قواعد التحقق من صحة البيانات.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // قواعد التحقق للطلب
            'full_name' => 'required|string|max:255',
            'phone'     =>
                'required|string|min:19|max:15'|
                'regex:/^(\+?9665|9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/',
            'address'   => 'required|string|max:255',
            'city'      => 'required|string|max:100',
            'state'     => 'required|string|max:100',

        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => 'الاسم الكامل',
            'phone' => 'رقم الجوال',
            'address' => 'العنوان',
            'city' => 'المدينة',
            'state' => 'المحافظة',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'يرجى إدخال الاسم الكامل',
            'full_name.max' => 'الاسم الكامل يجب ألا يتجاوز :255 حرف',
            'phone.required' => 'يرجى إدخال رقم الهاتف',
            'phone.max' => 'تأكد أن رقم الجوال رقم سعودي صحيح',
            'phone.min'=>'تأكد أن رقم الجوال رقم سعودي صحيح',
            'phone.regex'=>'تأكد أن رقم الجوال رقم سعودي صحيح',
            'address.required' => 'يرجى إدخال العنوان',
            'address.max' => 'العنوان يجب ألا يتجاوز :255 حرف',
            'city.required' => 'يرجى اختيار المدينة',
            'city.max' => 'اسم المدينة يجب ألا يتجاوز :100 حرف',
            'state.required' => 'يرجى اختيار المحافظة',
            'state.exists' => 'المحافظة المختارة غير صالحة',
        ];
    }
}
