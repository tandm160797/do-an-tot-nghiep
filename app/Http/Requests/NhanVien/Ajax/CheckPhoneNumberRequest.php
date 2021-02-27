<?php

namespace App\Http\Requests\NhanVien\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class CheckPhoneNumberRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'so_dien_thoai' => 'bail|required|regex:/^0[35789]\d{8}$/m'
        ];
    }

    public function messages()
    {
        return [
            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại!',
            'so_dien_thoai.regex' => 'Số điện thoại phải đúng định dạng số điện thoại Việt Nam!'
        ];
    }
}
