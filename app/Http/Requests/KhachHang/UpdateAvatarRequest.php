<?php

namespace App\Http\Requests\KhachHang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'anh_dai_dien' => 'bail|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'anh_dai_dien.mimes' => 'Vui lòng chọn ảnh đại diện đúng định dạng (png,jpg,jpeg)!'
        ];
    }
}
