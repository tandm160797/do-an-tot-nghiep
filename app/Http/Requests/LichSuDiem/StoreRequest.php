<?php

namespace App\Http\Requests\LichSuDiem;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'khach_hang_id' => 'bail|required|numeric',
            'diem' => 'bail|required|numeric',
            'ghi_chu' => 'bail|required'
        ];
    }

    public function messages()
    {
        return [
            'khach_hang_id.required' => 'Vui lòng nhập khách hàng!',
            'khach_hang_id.numeric' => 'Khách hàng phải là số!',
            'diem.required' => 'Vui lòng nhập điểm!',
            'diem.numeric' => 'Điểm phải là số!',
            'ghi_chu.required' => 'Vui lòng nhập ghi chú!'
        ];
    }
}
