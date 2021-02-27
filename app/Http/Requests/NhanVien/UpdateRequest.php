<?php

namespace App\Http\Requests\NhanVien;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'loai_thuc_nhan_vien_id' => 'bail|numeric',
        ];
    }

    public function messages()
    {
        return [
            'loai_thuc_nhan_vien_id.numeric' => 'Loại nhân viên phải là số!',
        ];
    }
}
