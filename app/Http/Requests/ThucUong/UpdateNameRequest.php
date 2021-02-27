<?php

namespace App\Http\Requests\ThucUong;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten' => 'bail|required|unique:thuc_uong,ten,' . $this->id
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Vui lòng nhập tên thức uống!',
            'ten.unique' => 'Tên thức uống đã tồn tại!'
        ];
    }
}
