<?php

namespace App\Http\Requests\NguyenLieu;

use Illuminate\Foundation\Http\FormRequest;

class ListByQuantityExistsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'so_luong_ton' => 'bail|required'
        ];
    }

    public function messages()
    {
        return [
            'so_luong_ton.required' => 'Vui lòng nhập số lượng tồn!'
        ];
    }
}
