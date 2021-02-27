<?php

namespace App\Http\Requests\ThucUong;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceRequest extends FormRequest
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
