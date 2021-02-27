<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHoaDonNhapRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nhan_vien_id' => 'bail|required|numeric',
            'tong_tien' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nhan_vien_id.required' => 'Vui lòng nhập nhân viên!',
            'nhan_vien_id.numeric' => 'Nhân viên phải là số!',
            'tong_tien.required' => 'Vui lòng nhập tổng tiền!',
            'tong_tien.numeric' => 'Tổng tiền phải là số!'
        ];
    }
}
