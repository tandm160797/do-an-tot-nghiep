<?php

namespace App\Http\Requests\NguyenLieu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules($id = null)
    {
        return [
            'ten' => 'bail|nullable|unique:nguyen_lieu,ten,' . $id,
            'so_luong_ton' => 'bail|nullable|numeric',
            'gia' => 'bail|nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'ten.unique' => 'Nguyên liệu đã tồn tại!',
            'so_luong_ton.numeric' => 'Số lượng tồn phải là số!',
            'gia.numeric' => 'Giá phải là số!'
        ];
    }
}
