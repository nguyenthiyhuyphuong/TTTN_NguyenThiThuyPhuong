<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>['required'],
            'link'=>['required'],
            'image'=>['required'],

            'position'=>['required']

        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Tên thương hiệu không được để trống',
            
            'link.required'=>'link không được để trống',

            'image.required'=>'hình ảnh không được để trống',

            'position.required'=>'position không được để trống'


        ];
    }
}
