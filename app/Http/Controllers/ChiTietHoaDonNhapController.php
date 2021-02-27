<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreChiTietHoaDonNhapRequest;
use App\Http\Requests\UpdateChiTietHoaDonNhapRequest;
use Illuminate\Support\Facades\Validator;
use App\ChiTietHoaDonNhap;
use App\HoaDonNhap;
use App\NguyenLieu;
use App\Helpers\SCRole;

class ChiTietHoaDonNhapController extends Controller
{
    public function index()
    {
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên kho')) {
            $danhSachHoaDonNhap = HoaDonNhap::get();
            $danhSachChiTietHoaDonNhap = ChiTietHoaDonNhap::whereIn('hoa_don_nhap_id', $danhSachHoaDonNhap->modelKeys())->get();
            if (count($danhSachChiTietHoaDonNhap) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách chi tiết hoá đơn nhập thành công!',
                    'data' => $danhSachChiTietHoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'Danh sách chi tiết hoá đơn nhập rỗng!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function store(Request $request)
    {
        $storeChiTietHoaDonNhapRequest = new StoreChiTietHoaDonNhapRequest;
        $validation = Validator::make($request->all(), $storeChiTietHoaDonNhapRequest->rules(), $storeChiTietHoaDonNhapRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên kho')) {
            $hoaDonNhap = HoaDonNhap::find($request->hoa_don_nhap_id);
            $nguyenLieu = NguyenLieu::find($request->nguyen_lieu_id);
            if (!empty($hoaDonNhap) && !empty($nguyenLieu)) {
                $chiTiethoaDonNhap = new ChiTietHoaDonNhap;
                $chiTiethoaDonNhap->hoa_don_id = $request->hoa_don_nhap_id;
                $chiTiethoaDonNhap->nguyen_lieu_id = $request->nguyen_lieu_id;
                $chiTiethoaDonNhap->so_luong = $request->so_luong;
                $chiTiethoaDonNhap->gia = $request->gia;
                $chiTiethoaDonNhap->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Thêm chi tiết hoá đơn nhập thành công!',
                    'data' => $chiTiethoaDonNhap
                ]);
            }
            if (empty($nguyenLieu)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Thêm chi tiết hoá đơn nhập thất bại, nguyên liệu không tồn tại!',
                    'data' => null
                ]);
            }
            if (empty($hoaDonNhap)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Thêm chi tiết hoá đơn nhập thất bại, hoá đơn không tồn tại!',
                    'data' => null
                ]);
            }
        }
        return SCRole::unauthorized();
    }

    public function show($id)
    {
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên kho')) {
            $chiTietHoaDonNhap = ChiTietHoaDonNhap::find($id);
            if (!empty($chiTietHoaDonNhap)) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy chi tiết hoá đơn nhập thành công!',
                    'data' => $chiTietHoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Lấy chi tiết hoá đơn nhập thất bại, không tìm thấy chi tiết hoá đơn nhập theo theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function update(Request $request, $id)
    {
        $updateChiTietHoaDonNhapRequest = new UpdateChiTietHoaDonNhapRequest;
        $validation = Validator::make($request->all(), $updateChiTietHoaDonNhapRequest->rules(), $updateChiTietHoaDonNhapRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên kho')) {
            $chiTietHoaDonNhap = ChiTietHoaDonNhap::find($id);
            if (!empty($chiTietHoaDonNhap)) {
                if (isset($request->hoa_don_nhap_id)) {
                    $hoaDonNhap = HoaDonNhap::find($request->hoa_don_nhap_id);
                    if (!empty($hoaDonNhap)) {
                        $chiTiethoaDonNhap->hoa_don_nhap_id = $request->hoa_don_nhap_id;
                    }
                    else {
                        return response()->json([
                            'code' => 400,
                            'message' => 'Thêm chi tiết hoá đơn nhập thất bại, hoá đơn không tồn tại!',
                            'data' => null
                        ]);
                    }
                }
                if (isset($request->nguyen_lieu_id)) {
                    $nguyenLieu = NguyenLieu::find($request->nguyen_lieu_id);
                    if (!empty($nguyenLieu)) {
                        $chiTiethoaDonNhap->nguyen_lieu_id = $request->nguyen_lieu_id;
                    }
                    else {
                        return response()->json([
                            'code' => 400,
                            'message' => 'Thêm chi tiết hoá đơn nhập thất bại, nguyên liệu không tồn tại!',
                            'data' => null
                        ]);
                    }
                }
                if (isset($request->so_luong)) {
                    $chiTiethoaDonNhap->so_luong = $request->so_luong;
                }
                if (isset($request->gia)) {
                    $chiTiethoaDonNhap->gia = $request->gia;
                }
                $chiTiethoaDonNhap->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Cập nhật chi tiết hoá đơn nhập thành công!',
                    'data' => $hoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Cập nhật chi tiết hoá đơn nhập thất bạị, không tìm thấy chi tiết hoá đơn nhập theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function destroy($id)
    {
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $chiTiethoaDonNhap = ChiTietHoaDonNhap::find($id);
            if (!empty($chiTiethoaDonNhap)) {
                $chiTiethoaDonNhap->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'Xoá chi tiết hoá đơn nhập thành công!',
                    'data' => $chiTiethoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Xoá chi tiết hoá đơn nhập thất bại, không tìm thấy chi tiết hoá đơn nhập theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
