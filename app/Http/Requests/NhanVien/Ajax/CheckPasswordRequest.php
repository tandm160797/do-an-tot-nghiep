<?php

namespace App\Http\Requests\NhanVien\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class CheckPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mat_khau' => 'bail|required|min:6|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ];
    }

    public function messages()
    {
        return [
            'mat_khau.required' => 'Vui lòng nhập mật khẩu!',
            'mat_khau.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự!',
            'mat_khau.max' => 'Mật khẩu chỉ chứa tối đa 32 ký tự!',
            'mat_khau.regex' => 'Mật khẩu phải chứa ít nhất 1 ký in hoa, 1 ký tự thường và 1 ký tự số!'
        ];
    }
}