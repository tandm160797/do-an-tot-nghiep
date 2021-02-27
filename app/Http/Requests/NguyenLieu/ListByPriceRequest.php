<?php

namespace App\Http\Requests\NguyenLieu;

use Illuminate\Foundation\Http\FormRequest;

class ListByPriceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'gia' => 'bail|required'
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Vui lòng nhập giá!'
        ];
    }
}
