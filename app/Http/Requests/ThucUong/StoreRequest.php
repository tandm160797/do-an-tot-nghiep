<?php

namespace App\Http\Requests\ThucUong;

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
            'loai_thuc_uong_id' => 'bail|required|numeric',
            'ten' => 'bail|required|unique:thuc_uong',
            'hinh_anh' => 'bail|mimes:jpg,png,jpeg',
            'gia' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'loai_thuc_uong_id.required' => 'Vui lòng nhập loại thức uống!',
            'loai_thuc_uong_id.numeric' => 'Loại thức uống phải là số!',
            'ten.required' => 'Vui lòng nhập tên thức uống!',
            'ten.unique' => 'Tên thức uống đã tồn tại!',
            'hinh_anh.mimes' => 'Vui lòng chọn hình ảnh đúng định dạng (jpg,png,jpeg)!',
            'gia.required' => 'Vui lòng nhập giá!',
            'gia.numeric' => 'Giá phải là số!'
        ];
    }
}
