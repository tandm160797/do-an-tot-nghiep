<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChiTietHoaDonBanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hoa_don_nhap_id' => 'bail|numeric',
            'nguyen_lieu_id' => 'bail|numeric',
            'so_luong' => 'bail|numeric',
            'gia' => 'bail|numeric'
        ];
    }

    public function messages()
    {
        return [
            'hoa_don_nhap_id.numeric' => 'Hóa đơn nhập phải là số!',
            'nguyen_lieu_id.numeric' => 'Nguyên liệu phải là số!',
            'so_luong.numeric' => 'Số lượng phải là số!',
            'gia.numeric' => 'Giá phải là số!'
        ];
    }
}
