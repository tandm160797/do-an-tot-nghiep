<?php

namespace App\Http\Requests\NhanVien;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mat_khau' => 'bail|required|min:6|max:32|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'mat_khau_confirmation' => 'bail|required|min:6|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ];
    }

    public function messages()
    {
        return [
            'mat_khau.required' => 'Vui lòng nhập mật khẩu!',
            'mat_khau.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự!',
            'mat_khau.max' => 'Mật khẩu chỉ chứa tối đa 32 ký tự!',
            'mat_khau.confirmed' => 'Mật khẩu không trùng khớp!',
            'mat_khau.regex' => 'Mật khẩu phải chứa ít nhất 1 ký in hoa, 1 ký tự thường và 1 ký tự số!',
            'mat_khau_confirmation.required' => 'Vui lòng nhập xác nhận mật khẩu!',
            'mat_khau_confirmation.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự!',
            'mat_khau_confirmation.max' => 'Mật khẩu chỉ chứa tối đa 32 ký tự!',
            'mat_khau_confirmation.regex' => 'Mật khẩu phải chứa ít nhất 1 ký in hoa, 1 ký tự thường và 1 ký tự số!'
        ];
    }
}
