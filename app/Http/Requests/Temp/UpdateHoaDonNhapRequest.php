<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHoaDonNhapRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nhan_vien_id' => 'bail|numeric',
            'tong_tien' => 'bail|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nhan_vien_id.numeric' => 'Nhân viên phải là số!',
            'tong_tien.numeric' => 'Tổng tiền phải là số!'
        ];
    }
}
