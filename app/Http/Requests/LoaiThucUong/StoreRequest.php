<?php

namespace App\Http\Requests\LoaiThucUong;

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
            'ten' => 'bail|required|unique:loai_thuc_uong',
            'anh_dai_dien' => 'bail|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Vui lòng nhập tên loại thức uống!',
            'ten.unique' => 'Loại thức uống đã tồn tại!',
            'anh_dai_dien.mimes' => 'Vui lòng chọn ảnh đại diện đúng định dạng (png,jpg,jpeg)!'
        ];
    }
}
