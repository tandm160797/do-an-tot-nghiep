<?php

namespace App\Http\Requests\NguyenLieu;

use Illuminate\Foundation\Http\FormRequest;

class ListByNameRequest extends FormRequest
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
