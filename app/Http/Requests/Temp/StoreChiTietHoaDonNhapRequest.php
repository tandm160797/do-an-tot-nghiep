<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChiTietHoaDonNhapRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hoa_don_nhap_id' => 'bail|required|numeric',
            'nguyen_lieu_id' => 'bail|required|numeric',
            'so_luong' => 'bail|required|numeric',
            'gia' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'hoa_don_nhap_id.required' => 'Vui lòng nhập hóa đơn nhập!',
            'hoa_don_nhap_id.numeric' => 'Hóa đơn nhập phải là số!',
            'nguyen_lieu_id.required' => 'Vui lòng nhập nguyên liệu!',
            'nguyen_lieu_id.numeric' => 'Nguyên liệu phải là số!',
            'so_luong.required' => 'Vui lòng nhập số lượng!',
            'so_luong.numeric' => 'Số lượng phải là số!',
            'gia.required' => 'Vui lòng nhập giá!',
            'gia.numeric' => 'Giá phải là số!'
        ];
    }
}
