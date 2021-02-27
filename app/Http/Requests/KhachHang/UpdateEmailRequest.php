<?php

namespace App\Http\Requests\KhachHang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'bail|required|regex:/^[\w\.]{1,32}@[a-z\d]{2,}(\.[a-z\d]{2,4}){1,2}$/i',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email!',
            'email.regex' => 'Vui lòng nhập email đúng định dạng!'
        ];
    }
}
