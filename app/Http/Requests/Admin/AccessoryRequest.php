<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AccessoryRequest extends FormRequest
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

        $rules = [
            'name' => 'required|max:255|',
            'description'  => 'string|nullable',
            'category_id'  => 'required|exists:categories,id',
            'price'=>'required|numeric|gt:0',
            'quantity'=>'required|integer|gt:0'
        ];
        if($this->isMethod('post')){
            $rules ['images.*']  = 'nullable|image|max:2048';
        }
        if($this->isMethod('put') || $this->isMethod('patch')){
            $rules ['images.*']  = 'nullable|image|max:2048';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم المنتج مطلوب',
            'name.max' => 'اسم المنتج يجب أن لا يتجاوز 255 حرفًا',
            'description.required' => 'وصف المنتج مطلوب',
            'price.required' => 'سعر المنتج مطلوب',
            'price.numeric' => 'يجب أن يكون السعر رقمًا',
            'price.gt' => 'يجب أن يكون السعر أكبر من الصفر',
            'category_id.required' => 'يجب اختيار القسم',
            'category_id.exists' => 'الفئة المحددة غير موجودة',
            'images.*.image' => 'يجب أن يكون الملف صورة',
            'images.*.max' => 'يجب أن لا يتجاوز حجم الصورة 2 ميجابايت'
        ];
    }


}
