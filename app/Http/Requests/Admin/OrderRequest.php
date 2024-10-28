<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'products.*.id' => 'required|exists:products,id',
            'seat_cover' => 'required|array',
            'cover_color' => 'required|array',
            'seat_count' => 'required|array',
            'car_brand' => 'required|array',
            'car_model' => 'required|array',
            'made_year' => 'required|array',
            'bag_option' => 'required|array',
            'talbisa_count' => 'required|array',
            'talbisa_price' => 'required|array',
            'talbisa_count_price' => 'required|array',
            'full_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'promo_code' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'المستخدم المحدد غير موجود',
            'products.required' => 'يرجى إضافة منتج واحد على الأقل',
            'products.*.id.required' => 'يرجى اختيار اللون',
            'products.*.id.exists' => 'اللون المحدد غير موجود',

            'full_name.required' => 'الاسم  مطلوب.',
            'full_name.string'   => 'الاسم  يجب أن يكون نص.',
            'full_name.max'      => 'اسمك الكامل يجب أن لا يتجاوز 255 حرفًا.',

            'phone.required'     => 'رقم الهاتف مطلوب.',
            'phone.numeric'      => 'رقم الهاتف يجب أن يكون أرقام فقط.',
            'phone.digits'       => 'رقم الهاتف يجب أن يتكون من 11 رقمًا.',

            'address.required'   => 'العنوان مطلوب.',
            'address.string'     => 'العنوان يجب أن يكون نص.',
            'address.max'        => 'العنوان يجب أن لا يتجاوز 255 حرفًا.',

            'city.required'      => 'اسم المدينة مطلوب .',
            'city.string'        => 'اسم المدينة يجب أن تكون نص.',
            'city.max'           => 'اسم المدينة يجب أن لا تتجاوز 100 حرف.',

            'state.required'     => 'اسم المحافظة مطلوب.',
            'state.string'       => 'اسم المحافظة يجب أن تكون نص.',
            'state.max'          => 'اسم المحافظة يجب أن لا تتجاوز 100 حرف.',
        ];
    }
}
