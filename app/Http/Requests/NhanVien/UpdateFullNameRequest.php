<?php

namespace App\Http\Requests\NhanVien;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFullNameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_ten' => 'bail|required'
        ];
    }

    public function messages()
    {
        return [
            'ho_ten.required' => 'Vui lòng nhập họ tên!'
        ];
    }
}
