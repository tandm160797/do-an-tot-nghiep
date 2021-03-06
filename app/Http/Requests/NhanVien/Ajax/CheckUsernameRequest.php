<?php

namespace App\Http\Requests\NhanVien\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class CheckUsernameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten_dang_nhap' => 'bail|required|unique:nhan_vien'
        ];
    }

    public function messages()
    {
        return [
            'ten_dang_nhap.required' => 'Vui lòng nhập tên đăng nhập!',
            'ten_dang_nhap.unique' => 'Tên đăng nhập đã tồn tại!'
        ];
    }
}
