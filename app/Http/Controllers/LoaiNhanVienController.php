<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLoaiNhanVienRequest;
use App\Http\Requests\UpdateLoaiNhanVienRequest;
use Illuminate\Support\Facades\Validator;
use App\LoaiNhanVien;
use App\Helpers\SCRole;

class LoaiNhanVienController extends Controller
{
    public function index()
    {
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $danhSachLoaiNhanVien = LoaiNhanVien::get();
            if (count($danhSachLoaiNhanVien) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách loại nhân viên thành công!',
                    'data' => $danhSachLoaiNhanVien
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'Danh sách loại nhân viên rỗng!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function store(Request $request)
    {
        $storeLoaiNhanVienRequest = new StoreLoaiNhanVienRequest;
        $validation = Validator::make($request->all(), $storeLoaiNhanVienRequest->rules(), $storeLoaiNhanVienRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $loaiNhanVien = new LoaiNhanVien;
            $loaiNhanVien->ten = $request->ten;
            $loaiNhanVien->save();
            return response()->json([
                'code' => 200,
                'message' => 'Thêm loại nhân viên thành công!',
                'data' => $loaiNhanVien
            ]);
        }
        return SCRole::unauthorized();
    }

    public function show($id)
    {
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $loaiNhanVien = LoaiNhanVien::find($id);
            if (!empty($loaiNhanVien)) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy loại nhân viên thành công!',
                    'data' => $loaiNhanVien
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Lấy loại nhân viên thất bại, không tìm thấy loại nhân viên theo theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function update(Request $request, $id)
    {
        $updateLoaiNhanVienRequest = new UpdateLoaiNhanVienRequest;
        $validation = Validator::make($request->all(), $updateLoaiNhanVienRequest->rules(), $updateLoaiNhanVienRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $loaiNhanVien = LoaiNhanVien::find($id);
            if (!empty($loaiNhanVien)) {
                if (isset($request->ten)) {
                    $loaiNhanVien->ten = $request->ten;
                }
                $loaiNhanVien->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Cập nhật loại nhân viên thành công!',
                    'data' => $loaiThucUong
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Cập nhật loại nhân viên thất bạị, không tìm thấy loại nhân viên theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function destroy($id)
    {
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $loaiNhanVien = loaiNhanVien::find($id);
            if (!empty($loaiNhanVien)) {
                $loaiNhanVien->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'Xoá loại nhân viên thành công!',
                    'data' => $loaiNhanVien
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Xoá loại nhân viên thất bại, không tìm thấy loại nhân viên theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
