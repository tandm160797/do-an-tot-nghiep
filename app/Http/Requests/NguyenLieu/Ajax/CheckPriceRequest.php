<?php

namespace App\Http\Requests\NguyenLieu\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class CheckPriceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'gia' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'gia.required' => 'Vui lòng nhập giá!',
            'gia.numeric' => 'Giá phải là số!'
        ];
    }
}