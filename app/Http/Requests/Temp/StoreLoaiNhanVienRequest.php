<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoaiNhanVienRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    function rules()
    {
        return [
            'ten' => 'bail|required|unique:loai_nhan_vien',
        ];
    }

    public function messages() {
        return [
            'ten.required' => 'Vui lòng nhập tên loại nhân viên!',
            'ten.unique' => 'Loại nhân viên đã tồn tại!'
        ];
    }
}
