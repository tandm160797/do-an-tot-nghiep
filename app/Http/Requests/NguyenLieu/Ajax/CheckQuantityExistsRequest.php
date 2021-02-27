<?php

namespace App\Http\Requests\NguyenLieu\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class CheckQuantityExistsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'so_luong_ton' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'so_luong_ton.required' => 'Vui lòng nhập số lượng tồn!',
            'so_luong_ton.numeric' => 'Số lượng tồn phải là số!'
        ];
    }
}