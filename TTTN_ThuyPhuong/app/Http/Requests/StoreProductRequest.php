<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            // 'name'=>['required','unique:product'],
            // 'detail'=>['required'],
            // 'category_id'=>['required'],
            // 'price'=>['required'],
            // 'image'=>['required'],
            // 'brand_id'=>['required']
            'name' => 'required',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Tên thương hiệu không được để trống',
            // 'name.unique'=>'Tên thương hiệu đã tồn tại',
            // 'detail.required'=>'Từ khóa không được để trống',
            // 'price.required'=>'Giá không được để trống',
            // 'image.required'=>'Ảnh không được để trống',
            // 'category_id.required'=>'Danh mục không được trống',
            // 'brand_id.required'=>'chọn thương hiệu'

        ];
    }
}
