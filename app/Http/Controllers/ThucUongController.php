<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ThucUong\StoreRequest;
use App\Http\Requests\ThucUong\UpdateRequest;
use App\Http\Requests\ThucUong\UpdateTypeRequest;
use App\Http\Requests\ThucUong\UpdateNameRequest;
use App\Http\Requests\ThucUong\UpdateImageRequest;
use App\Http\Requests\ThucUong\UpdatePriceRequest;
use Illuminate\Support\Facades\Validator;
use App\ThucUong;
use App\LoaiThucUong;
use App\Helpers\SCImage;
use App\ChiTietHoaDonBan;
use DB;

class ThucUongController extends Controller
{
    public function listByType(Request $request, $loaiThucUongId)
    {
        $loaiThucUong = LoaiThucUong::find($loaiThucUongId);
        if (!empty($loaiThucUong)) {
            $danhSachThucUong = ThucUong::where('loai_thuc_uong_id', $loaiThucUong->id)->get();
            if (count($danhSachThucUong) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách thức uống thành công!',
                    'data' => $danhSachThucUong
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Danh sách thức uống rỗng!',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Loại thức uống không tồn tại!',
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
        $loaiThucUong = LoaiThucUong::find($request->loai_thuc_uong_id);
        if (!empty($loaiThucUong)) {
            if ($request->hasFile('hinh_anh')) {
                $thucUong = new ThucUong;
                $thucUong->loai_thuc_uong_id = $request->loai_thuc_uong_id;
                $thucUong->ten = $request->ten;
                $thucUong->hinh_anh = SCImage::upload($request->hinh_anh, 'thuc-uong', 300);
                $thucUong->gia = $request->gia;
                $thucUong->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Thêm thức uống thành công!'
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Không tìm thấy ảnh!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Loại thức uống không tồn tại!'
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
        $thucUong = ThucUong::find($id);
        if (!empty($thucUong)) {
            if ($request->hasFile('hinh_anh')) {
                if ($thucUong->anh_dai_dien) {
                    SCImage::delete('thuc-uong', $thucUong->hinh_anh);
                }
                $thucUong->update(['loai_thuc_uong_id' => $request->loai_thuc_uong_id, 'ten' => $request->ten, 'hinh_anh' => SCImage::upload($request->hinh_anh, 'thuc-uong', 300), 'gia' => $request->gia]);
                return response()->json([
                    'code' => 200,
                    'message' => 'Cập nhật thành công!',
                    'ad' => $request->loai_thuc_uong_id
                ]);
            }
            $thucUong->update(['loai_thuc_uong_id' => $request->loai_thuc_uong_id, 'ten' => $request->ten, 'gia' => $request->gia]);
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật loại thức uống thành công!'
            ]);
        }
        
        return response()->json([
            'code' => 400,
            'message' => 'Thức uống không tồn tại!'
        ]);
    }

    public function updateType(Request $request, $id)
    {
        $updateTypeRequest = new UpdateTypeRequest;
        $validation = Validator::make($request->all(), $updateTypeRequest->rules(), $updateTypeRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $thucUong = ThucUong::find($id);
        if (!empty($thucUong)) {
            $thucUong->update(['loai_thuc_uong_id' => $request->loai_thuc_uong_id]);
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật loại thức uống thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Thức uống không tồn tại!'
        ]);
    }

    public function updateName(Request $request, $id)
    {
        $updateNameRequest = new UpdateNameRequest;
        $validation = Validator::make($request->all(), $updateNameRequest->rules(), $updateNameRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $thucUong = ThucUong::find($id);
        if (!empty($thucUong)) {
            $thucUong->update(['ten' => $request->ten]);
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật tên thức uống thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Thức uống không tồn tại!'
        ]);
    }
    public function updateImage(Request $request, $id)
    {
        $updateImageRequest = new UpdateImageRequest;
        $validation = Validator::make($request->all(), $updateImageRequest->rules(), $updateImageRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $thucUong = ThucUong::find($id);
        if (!empty($thucUong)) {
            if ($request->hasFile('hinh_anh')) {
                if (SCImage::delete('thuc-uong', $thucUong->hinh_anh)) {
                    if ($thucUong->hinh_anh) {
                        SCImage::delete('thuc-uong', $thucUong->hinh_anh);
                    }
                    $thucUong->hinh_anh = SCImage::upload($request->hinh_anh, 'thuc-uong', 300);
                }
                return response()->json([
                    'code' => 200,
                    'message' => 'Cập nhật hình ảnh thức uống thành công!'
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Không tìm thấy hình ảnh!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Thức uống không tồn tại!'
        ]);
    }
    public function updatePrice(Request $request, $id)
    {
        $updatePriceRequest = new UpdatePriceRequest;
        $validation = Validator::make($request->all(), $updatePriceRequest->rules(), $updatePriceRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $thucUong = ThucUong::find($id);
        if (!empty($thucUong)) {
            $thucUong->update(['gia' => $request->gia]);
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật giá thức uống thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Thức uống không tồn tại!'
        ]);
    }
    
    public function delete($id)
    {
        $thucUong = ThucUong::find($id);
        if (!empty($thucUong)) {
            $thucUong->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xoá thức uống thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Không tìm thấy thức uống theo yêu cầu!'
        ]);
    }

    //
    
    public function listBestsell($month)
    {
        $currentDate = date("Y-m-d");
        $timestamp = strtotime($currentDate);
        $year = date('Y', $timestamp);
        //
        $listBestsell = ChiTietHoaDonBan::selectRaw('thuc_uong_id, sum(chi_tiet_hoa_don_ban.so_luong) as tong_so_luong')
                    ->join('hoa_don_ban', 'chi_tiet_hoa_don_ban.hoa_don_ban_id', 'hoa_don_ban.id')
                    ->whereMonth('hoa_don_ban.ngay', $month)
                    ->whereYear('hoa_don_ban.ngay', $year)
                    ->groupBy('chi_tiet_hoa_don_ban.thuc_uong_id')
                    ->orderByDesc('tong_so_luong')
                    ->take(10)
                    ->get();
        //
        if (count($listBestsell) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy danh sách thức uống thành công!',
                'data' => $listBestsell
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Danh sách thức uống rỗng!',
            'data' => null
        ]);
    }
}
