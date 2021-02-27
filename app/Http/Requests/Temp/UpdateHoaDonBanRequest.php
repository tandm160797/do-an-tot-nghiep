<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHoaDonBanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nhan_vien_id' => 'bail|numeric',
            'khach_hang_id' => 'bail|numeric',
            'tong_tien' => 'bail|numeric',
            'diem' => 'bail|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nhan_vien_id.numeric' => 'Nhân viên phải là số!',
            'nhan_vien_id.numeric' => 'Khách hàng phải là số!',
            'tong_tien.numeric' => 'Tổng tiền phải là số!',
            'diem.numeric' => 'Điểm phải là số!'
        ];
    }
}
