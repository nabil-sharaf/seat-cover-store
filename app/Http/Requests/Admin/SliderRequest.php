<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        $rules =[
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'string|max:100',
            'button_link' => 'url',
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
            'title.required' => 'العنوان مطلوب.',
            'title.string' => 'يجب أن يكون العنوان نصًا.',
            'title.max' => 'يجب ألا يزيد العنوان عن 255 حرفًا.',
            'button_text.max' => 'يجب ألا يزيد نص الزر عن 100 حرف.',
            'button_link.url' => 'يجب أن يكون رابط الزر رابطًا صحيحًا.',
            'image.image' => 'يجب أن تكون الصورة من نوع صورة.',
            'image.max' => 'يجب ألا يزيد حجم الصورة عن 2 ميجابايت.',
        ];
    }
}
