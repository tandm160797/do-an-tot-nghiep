<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoaiThucUong\StoreRequest;
use App\Http\Requests\LoaiThucUong\UpdateRequest;
use Illuminate\Support\Facades\Validator;
use App\LoaiThucUong;
use App\Helpers\SCImage;

class LoaiThucUongController extends Controller
{
    public function list()
    {
        $danhSachLoaiThucUong = LoaiThucUong::get();
        if (count($danhSachLoaiThucUong) > 0) {
            return response()->json([
                'code' => 200, 
                'message' => 'Lấy danh sách loại thức uống thành công!',
                'data' => $danhSachLoaiThucUong
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Danh sách loại thức uống rỗng!',
            'data' => null
        ]);
    }

    public function store(Request $request)
    {
        $storeRequest = new StoreRequest;
        $validation = Validator::make($request->all(), $storeRequest->rules(), $storeRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        if ($request->hasFile('anh_dai_dien')) {
            $loaiThucUong = new LoaiThucUong;
            $loaiThucUong->ten = $request->ten;
            $loaiThucUong->anh_dai_dien = SCImage::upload($request->anh_dai_dien, 'loai-thuc-uong', 300);
            $loaiThucUong->save();
            return response()->json([
                'code' => 200,
                'message' => 'Thêm loại thức uống thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Không tìm thấy ảnh!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $updateRequest = new UpdateRequest;
        $validation = Validator::make($request->all(), $updateRequest->rules($id), $updateRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $loaiThucUong = LoaiThucUong::find($id);
        if (!empty($loaiThucUong)) {
            if ($request->hasFile('anh_dai_dien')) {
                if ($loaiThucUong->anh_dai_dien) {
                    SCImage::delete('loai-thuc-uong', $loaiThucUong->anh_dai_dien);
                }
                $loaiThucUong->update(['ten' => $request->ten, 'anh_dai_dien' => SCImage::upload($request->anh_dai_dien, 'loai-thuc-uong', 300)]);
                return response()->json([
                    'code' => 200,
                    'message' => 'Cập nhật thành công!'
                ]);
            }
            $loaiThucUong->update(['ten' => $request->ten, 'anh_dai_dien' => SCImage::upload($request->anh_dai_dien, 'loai-thuc-uong', 300)]);
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật thành công!'
            ]);
        }
    }

    public function delete($id)
    {
        $loaiThucUong = LoaiThucUong::find($id);
        if (!empty($loaiThucUong)) {
            $loaiThucUong->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xoá loại thức uống thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Không tìm thấy loại thức uống theo yêu cầu!',
        ]);
    }
}
