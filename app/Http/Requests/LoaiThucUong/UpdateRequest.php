<?php

namespace App\Http\Requests\LoaiThucUong;

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
            'anh_dai_dien' => 'bail|mimes:jpg,png,jpeg',
            'ten' => 'bail|required|unique:loai_thuc_uong,ten,' . $id
        ];
    }

    public function messages()
    {
        return [
            'anh_dai_dien.mimes' => 'Vui lòng chọn ảnh đại diện đúng định dạng (png,jpg,jpeg)!',
            'ten.required' => 'Vui lòng nhập tên loại thức uống!',
            'ten.unique' => 'Loại thức uống đã tồn tại!'
        ];
    }
}
