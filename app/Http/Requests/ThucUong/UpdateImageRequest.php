<?php

namespace App\Http\Requests\ThucUong;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hinh_anh' => 'bail|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'hinh_anh.mimes' => 'Vui lòng chọn hình ảnh đúng định dạng (jpg,png,jpeg)!'
        ];
    }
}
