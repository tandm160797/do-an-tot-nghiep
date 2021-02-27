<?php

namespace App\Http\Requests\NguyenLieu\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class CheckNameStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten' => 'bail|required|unique:nguyen_lieu'
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Vui lòng nhập tên nguyên liệu!',
            'ten.unique' => 'Nguyên liệu đã tồn tại!'
        ];
    }
}