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
    $id = $this->route('accessory') ? $this->route('accessory')->id : null;
        $rules = [
            'name' => 'required|max:255|unique:accessories,name,'.$id,
            'description'  => 'string|nullable',
            'category_id'  => 'required|exists:categories,id',
            'price'=>'required|numeric|gt:0',
            'quantity'=>'required|integer|gt:0',
            'discount_type' => 'nullable|in:fixed,percentage',
            'discount_value' => 'nullable|required_if:discount_type,fixed,percentage|numeric|gt:0',
            'start_date' => 'nullable|required_if:discount_type,fixed,percentage|date',
            'end_date' => 'nullable|required_if:discount_type,fixed,percentage|date|after_or_equal:start_date',
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
            'images.*.max' => 'يجب أن لا يتجاوز حجم الصورة 2 ميجابايت',
            'discount_type.in' => 'نوع الخصم يجب أن يكون نسبة أو ثابت',
            'discount_value.required_if' => 'قيمة الخصم مطلوبة عند اختيار نوع الخصم',
            'discount_value.numeric' => 'يجب أن تكون قيمة الخصم رقمًا',
            'discount_value.gt' => 'يجب أن تكون قيمة الخصم أكبر من الصفر',
            'start_date.required_if' => 'تاريخ بداية الخصم مطلوب عند تحديد الخصم',
            'start_date.date' => 'يجب أن يكون تاريخ بداية الخصم تاريخًا صحيحًا',
            'end_date.required_if' => 'تاريخ نهاية الخصم مطلوب',
            'end_date.date' => 'يجب أن يكون تاريخ نهاية الخصم تاريخًا صحيحًا',
            'end_date.after_or_equal' => 'يجب أن يكون تاريخ نهاية الخصم مساويًا أو بعد تاريخ البداية',
        ];
    }


}
