<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoaiNhanVienRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    function rules()
    {
        return [
            'ten' => 'bail|unique:loai_nhan_vien,ten,' . $this->id,
        ];
    }

    public function messages() {
        return [
            'ten.unique' => 'Loại nhân viên đã tồn tại!'
        ];
    }
}
