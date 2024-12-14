<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_type' => 'required|in:earth,seat,accessory',
            'category_id' => 'required|exists:categories,id',
            'product_count' => 'required|integer|min:1',
            'accessory_id' => 'required_if:product_type,accessory|exists:accessories,id',

            // Required only for earth/seat products
            'made_year' => 'required_if:product_type,earth,seat',
            'cover_color' => 'required_if:product_type,earth,seat|exists:cover_colors,id',
            'seat_count' => 'required_if:product_type,earth,seat|exists:seat_counts,id',
            'car_brand' => 'required_if:product_type,earth,seat|exists:car_brands,id',
            'car_model' => 'required_if:product_type,earth,seat|exists:car_models,id',
            'bag_option' => 'nullable',
            'parent_id'=>'nullable|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'product_type.required' => 'نوع المنتج مطلوب',
            'product_type.in' => 'نوع المنتج غير صحيح',
            'category_id.required' => 'القسم مطلوب',
            'category_id.exists' => 'القسم غير موجود',
            'product_count.required' => 'الكمية مطلوبة',
            'product_count.integer' => 'الكمية يجب أن تكون رقم صحيح',
            'product_count.min' => 'الكمية يجب أن تكون 1 على الأقل',
            'made_year.required_if' => 'سنة الصنع مطلوبة',
            'cover_color.required_if' => 'لون الغطاء مطلوب',
            'seat_count.required_if' => 'عدد المقاعد مطلوب',
            'car_brand.required_if' => 'ماركة السيارة مطلوبة',
            'car_model.required_if' => 'موديل السيارة مطلوب',
        ];
    }
}
