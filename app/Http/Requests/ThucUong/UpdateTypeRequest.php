<?php

namespace App\Http\Requests\ThucUong;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'loai_thuc_uong_id' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'loai_thuc_uong_id.required' => 'Vui lòng nhập loại thức uống!',
            'loai_thuc_uong_id.numeric' => 'Loại thức uống phải là số!',
        ];
    }
}
