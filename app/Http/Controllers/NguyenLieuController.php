<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NguyenLieu\ListByNameRequest;
use App\Http\Requests\NguyenLieu\ListByQuantityExistsRequest;
use App\Http\Requests\NguyenLieu\ListByPriceRequest;
use App\Http\Requests\NguyenLieu\StoreRequest;
use App\Http\Requests\NguyenLieu\UpdateRequest;
use App\Http\Requests\NguyenLieu\Ajax\CheckNameStoreRequest;
use App\Http\Requests\NguyenLieu\Ajax\CheckNameUpdateRequest;
use App\Http\Requests\NguyenLieu\Ajax\CheckQuantityExistsRequest;
use App\Http\Requests\NguyenLieu\Ajax\CheckPriceRequest;
use Illuminate\Support\Facades\Validator;
use App\NguyenLieu;
use App\LichSuChinhSuaSoLuongNguyenLieu;
use Carbon\Carbon;

class NguyenLieuController extends Controller
{
    public function list($page)
    {
        if ($page >= 1) {
            $danhSachNguyenLieu = NguyenLieu::offset(($page - 1) * 10)
                                                ->limit(10)
                                                ->get();
            if (count($danhSachNguyenLieu) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách nguyên liệu thành công!',
                    'data' => $danhSachNguyenLieu
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Danh sách nguyên liệu rỗng!',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Số trang không hợp lệ!',
            'data' => null
        ]);
    }   

    public function listSortByQuantityExists($page)
    {
        if ($page >= 1) {
            $danhSachNguyenLieu = NguyenLieu::orderBy('so_luong_ton')
                                                ->offset(($page - 1) * 10)
                                                ->limit(10)
                                                ->get();
            if (count($danhSachNguyenLieu) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách nguyên liệu thành công!',
                    'data' => $danhSachNguyenLieu
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Danh sách nguyên liệu rỗng!',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Số trang không hợp lệ!',
            'data' => null
        ]);
    }   

    public function listByName(Request $request)
    {
        $listByNameRequest = new ListByNameRequest;
        $validation = Validator::make($request->all(), $listByNameRequest->rules(), $listByNameRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $danhSachNguyenLieu = NguyenLieu::where('ten', 'like', '%' . $request->ten . '%')->get();
        if (count($danhSachNguyenLieu) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy danh sách nguyên liệu thành công!',
                'data' => $danhSachNguyenLieu
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Danh sách nguyên liệu rỗng!',
            'data' => null
        ]);
    }   

    public function listByQuantityExists(Request $request)
    {
        $listByQuantityExistsRequest = new ListByQuantityExistsRequest;
        $validation = Validator::make($request->all(), $listByQuantityExistsRequest->rules(), $listByQuantityExistsRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $danhSachNguyenLieu = NguyenLieu::where('so_luong_ton', $request->so_luong_ton)->get();
        if (count($danhSachNguyenLieu) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy danh sách nguyên liệu thành công!',
                'data' => $danhSachNguyenLieu
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Danh sách nguyên liệu rỗng!',
            'data' => null
        ]);
    }   

    public function listByPrice(Request $request)
    {
        $listByPriceRequest = new ListByPriceRequest;
        $validation = Validator::make($request->all(), $listByPriceRequest->rules(), $listByPriceRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $danhSachNguyenLieu = NguyenLieu::where('gia', $request->gia)->get();
        if (count($danhSachNguyenLieu) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy danh sách nguyên liệu thành công!',
                'data' => $danhSachNguyenLieu
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Danh sách nguyên liệu rỗng!',
            'data' => null
        ]);
    }

    //
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
        $nguyenLieu = new NguyenLieu;
        $nguyenLieu->ten = $request->ten;
        $nguyenLieu->don_vi_tinh = $request->don_vi_tinh;
        $nguyenLieu->so_luong_ton = 0;
        $nguyenLieu->gia = $request->gia;
        $nguyenLieu->save();
        return response()->json([
            'code' => 200,
            'message' => 'Thêm nguyên liệu thành công!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $nguyenLieu = NguyenLieu::find($id);
        $soLuongCu = $nguyenLieu->so_luong_ton;
        $soLuongMoi = $request->so_luong_ton;
        if ($soLuongCu != $soLuongMoi) {
            $lichSuChinhSuaSoLuongNguyenLieuController = new LichSuChinhSuaSoLuongNguyenLieu;
            $lichSuChinhSuaSoLuongNguyenLieuController->nhan_vien_id = auth()->user()->id;
            $lichSuChinhSuaSoLuongNguyenLieuController->nguyen_lieu_id = $nguyenLieu->id;
            $lichSuChinhSuaSoLuongNguyenLieuController->so_luong_cu = $soLuongCu;
            $lichSuChinhSuaSoLuongNguyenLieuController->so_luong_moi = $soLuongMoi;
            $lichSuChinhSuaSoLuongNguyenLieuController->ngay = Carbon::now();
            $lichSuChinhSuaSoLuongNguyenLieuController->save();
        }
        if (!empty($nguyenLieu)) {
            $updateRequest = new UpdateRequest;
            $validation = Validator::make($request->all(), $updateRequest->rules($nguyenLieu->id), $updateRequest->messages());
            if ($validation->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => $validation->messages()->first()
                ]);
            }
            $nguyenLieu->update(['ten' => $request->ten, 'don_vi_tinh' => $request->don_vi_tinh, 'so_luong_ton' => $request->so_luong_ton, 'gia' => $request->gia]);
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật nguyên liệu thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Nguyên liệu không tồn tại!'
        ]);
    }

    public function delete($id)
    {
        $nguyenLieu = NguyenLieu::find($id);
        if (!empty($nguyenLieu)) {
            $nguyenLieu->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xoá nguyên liệu thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Nguyên liệu không tồn tại!'
        ]);
    }

    //
    public function checkNameStore(Request $request)
    {
        $checkNameStoreRequest = new CheckNameStoreRequest;
        $validation = Validator::make($request->all(), $checkNameStoreRequest->rules(), $checkNameStoreRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }

    public function checkNameUpdate(Request $request)
    {
        $checkNameUpdateRequest = new CheckNameUpdateRequest;
        $validation = Validator::make($request->all(), $checkNameUpdateRequest->rules(), $checkNameUpdateRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }

    public function checkQuantityExists(Request $request)
    {
        $checkQuantityExistsRequest = new CheckQuantityExistsRequest;
        $validation = Validator::make($request->all(), $checkQuantityExistsRequest->rules(), $checkQuantityExistsRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }

    public function checkPrice(Request $request)
    {
        $checkPriceRequest = new CheckPriceRequest;
        $validation = Validator::make($request->all(), $checkPriceRequest->rules(), $checkPriceRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }
}
