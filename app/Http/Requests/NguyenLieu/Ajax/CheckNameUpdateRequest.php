<?php

namespace App\Http\Requests\NguyenLieu\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class CheckNameUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten' => 'bail|required'
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Vui lòng nhập tên nguyên liệu!'
        ];
    }
}