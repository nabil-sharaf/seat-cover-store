<?php

namespace App\Http\Requests\Admin;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
   public function authorize()
    {
        return true;
    }

    public function rules()
    {

     $rules = [
            'name' => 'required|max:255|',
            'description'  => 'string|nullable',
            'category_id'  => 'required|exists:categories,id',
            'status'       =>'nullable|in:0,1',
            'tatriz_color' =>'required|string',
        ];
        if($this->isMethod('post')){
           $rules ['image']  = 'required|image|max:2048';
        }
        if($this->isMethod('put') || $this->isMethod('patch')){
           $rules ['image']  = 'nullable|image|max:2048';
        }
        return $rules;
    }



    public function messages()
    {
        return [
            'name.required' => 'اسم المنتج مطلوب',
            'name.max' => 'اسم المنتج يجب أن لا يتجاوز 255 حرفًا',
            'description.required' => 'وصف المنتج مطلوب',
            'info.required' => 'حقل معلومات المنتج مطلوب',
            'price.required' => 'سعر المنتج مطلوب',
            'price.numeric' => 'يجب أن يكون السعر رقمًا',
            'price.gt' => 'يجب أن يكون السعر أكبر من الصفر',
             'categories.required' => 'يجب اختيار فئة واحدة على الأقل',
            'categories.array' => 'يجب أن تكون الفئات مصفوفة',
            'categories.*.exists' => 'الفئة المحددة غير موجودة',
            'images.*.image' => 'يجب أن يكون الملف صورة',
            'images.*.max' => 'يجب أن لا يتجاوز حجم الصورة 2 ميجابايت'
        ];
    }
}
