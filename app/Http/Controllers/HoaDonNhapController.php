<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreHoaDonNhapRequest;
use App\Http\Requests\UpdateHoaDonNhapRequest;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\HoaDonNhap;
use App\NhanVien;
use App\Helpers\SCRole;

class HoaDonNhapController extends Controller
{
    public function index()
    {
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên kho')) {
            $danhSachHoaDonNhap = HoaDonNhap::get();
            if (count($danhSachHoaDonNhap) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách hoá đơn nhập thành công!',
                    'data' => $danhSachHoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'Danh sách hoá đơn nhập rỗng!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function store(Request $request)
    {
        $storeHoaDonNhapRequest = new StoreHoaDonNhapRequest;
        $validation = Validator::make($request->all(), $storeHoaDonNhapRequest->rules(), $storeHoaDonNhapRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên kho')) {
            $nhanVien = NhanVien::find($request->nhan_vien_id);
            if (!empty($nhanVien)) {
                $hoaDonNhap = new HoaDonNhap;
                $hoaDonNhap->nhan_vien_id = $request->nhan_vien_id;
                $hoaDonNhap->ngay = Carbon::now();
                $hoaDonNhap->tong_tien = $request->tong_tien;
                $hoaDonNhap->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Thêm hoá đơn nhập thành công!',
                    'data' => $hoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Thêm hoá đơn nhập thất bại, nhân viên không tồn tại!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function show($id)
    {
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên kho')) {
            $hoaDonNhap = HoaDonNhap::find($id);
            if (!empty($hoaDonNhap)) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy hoá đơn nhập thành công!',
                    'data' => $hoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Lấy hoá đơn nhập thất bại, không tìm thấy hoá đơn nhập theo theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function update(Request $request, $id)
    {
        $updateHoaDonNhapRequest = new UpdateHoaDonNhapRequest;
        $validation = Validator::make($request->all(), $updateHoaDonNhapRequest->rules(), $updateHoaDonNhapRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên kho')) {
            $hoaDonNhap = HoaDonNhap::find($id);
            if (!empty($hoaDonNhap)) {
                if (isset($request->nhan_vien_id)) {
                    $nhanVien = NhanVien::find($request->nhan_vien_id);
                        if (!empty($nhanVien)) {
                            $hoaDonNhap->nhan_vien_id = $request->nhan_vien_id;
                        }
                        else {
                            return response()->json([
                                'code' => 400,
                                'message' => 'Thêm hoá đơn nhập thất bại, nhân viên không tồn tại!',
                                'data' => null
                            ]);
                        }
                }
                $hoaDonNhap->ngay = Carbon::now();
                if (isset($request->tong_tien)) {
                    $hoaDonNhap->tong_tien = $request->tong_tien;
                }
                $hoaDonNhap->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Cập nhật hoá đơn nhập thành công!',
                    'data' => $hoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Cập nhật hoá đơn nhập thất bạị, không tìm thấy hoá đơn nhập theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function destroy($id)
    {
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $hoaDonNhap = HoaDonNhap::find($id);
            if (!empty($hoaDonNhap)) {
                $hoaDonNhap->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'Xoá hoá đơn nhập thành công!',
                    'data' => $hoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Xoá hoá đơn nhập thất bại, không tìm thấy hoá đơn nhập theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
