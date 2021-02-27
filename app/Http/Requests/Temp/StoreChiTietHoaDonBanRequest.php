<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChiTietHoaDonBanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hoa_don_ban_id' => 'bail|required|numeric',
            'thuc_uong_id' => 'bail|required|numeric',
            'so_luong' => 'bail|required|numeric',
            'gia' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'hoa_don_ban_id.required' => 'Vui lòng nhập hóa đơn bán!',
            'hoa_don_ban_id.numeric' => 'Hóa đơn bán phải là số!',
            'thuc_uong_id.required' => 'Vui lòng nhập thức uống!',
            'thuc_uong_id.numeric' => 'Thức uống phải là số!',
            'so_luong.required' => 'Vui lòng nhập số lượng!',
            'so_luong.numeric' => 'Số lượng phải là số!',
            'gia.required.numeric' => 'Giá phải là số!',
            'gia.numeric' => 'Vui lòng nhập giá!'
        ];
    }
}
