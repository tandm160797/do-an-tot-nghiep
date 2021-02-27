<?php

namespace App\Http\Requests\NhanVien;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_ten' => 'bail|required',
            'ten_dang_nhap' => 'bail|required|unique:khach_hang',
            'mat_khau' => 'bail|required|min:6|max:32|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'mat_khau_confirmation' => 'bail|required|min:6|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ];
    }

    public function messages()
    {
        return [
            'ho_ten.required' => 'Vui lòng nhập họ tên!',
            'ten_dang_nhap.required' => 'Vui lòng nhập tên đăng nhập!',
            'ten_dang_nhap.unique' => 'Tên đăng nhập đã tồn tại!',
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
