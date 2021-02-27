<?php

namespace App\Http\Requests\NguyenLieu;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten' => 'bail|required|unique:nguyen_lieu',
            'don_vi_tinh' => 'bail|required',
            'gia' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Vui lòng nhập tên nguyên liệu!',
            'ten.unique' => 'Nguyên liệu đã tồn tại!',
            'don_vi_tinh.required' => 'Vui lòng nhập đơn vị tính!',
            'gia.required' => 'Vui lòng nhập giá!',
            'gia.numeric' => 'Giá phải là số!'
        ];
    }
}
