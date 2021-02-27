<?php

namespace App\Http\Requests\ThucUong;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules($id = null)
    {
        return [
            'loai_thuc_uong_id' => 'bail|numeric',
            'ten' => 'bail|unique:thuc_uong,ten,' . $id,
            'hinh_anh' => 'bail|mimes:jpg,png,jpeg',
            'gia' => 'bail|numeric'
        ];
    }

    public function messages()
    {
        return [
            'loai_thuc_uong_id.numeric' => 'Loại thức uống phải là số!',
            'ten.unique' => 'Tên thức uống đã tồn tại!',
            'hinh_anh.mimes' => 'Vui lòng chọn hình ảnh đúng định dạng (jpg,png,jpeg)!',
            'gia.numeric' => 'Giá phải là số!'
        ];
    }
}
