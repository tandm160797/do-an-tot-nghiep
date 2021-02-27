<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreHoaDonBanRequest;
use App\Http\Requests\UpdateHoaDonBanRequest;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\HoaDonBan;
use App\NhanVien;
use App\KhachHang;
use App\Helpers\SCRole;

class HoaDonBanController extends Controller
{
    public function index()
    {
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên thu ngân')) {
            $danhSachHoaDonBan = HoaDonBan::get();
            if (count($danhSachHoaDonBan) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách hoá đơn bán thành công!',
                    'data' => $danhSachHoaDonBan
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'Danh sách hoá đơn bán rỗng!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function store(Request $request)
    {
        $storeHoaDonBanRequest = new StoreHoaDonBanRequest;
        $validation = Validator::make($request->all(), $storeHoaDonBanRequest->rules(), $storeHoaDonBanRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên thu ngân')) {
            $nhanVien = NhanVien::find($request->nhan_vien_id);
            $khachHang = KhachHang::find($request->khach_hang_id);
            if (!empty($nhanVien) && !empty($khachHang)) {
                $hoaDonBan = new HoaDonBan;
                $hoaDonBan->nhan_vien_id = $request->nhan_vien_id;
                $hoaDonBan->khach_hang_id = $request->khach_hang_id;
                $hoaDonBan->ngay = Carbon::now();
                $hoaDonBan->tong_tien = $request->tong_tien;
                $hoaDonBan->diem = $request->diem;
                $hoaDonBan->trang_thai = 'Đã đặt';
                $hoaDonBan->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Thêm hoá đơn bán thành công!',
                    'data' => $hoaDonBan
                ]);
            }
            if (empty($nhanVien)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Thêm hoá đơn bán thất bại, nhân viên không tồn tại!',
                    'data' => null
                ]);
            }
            if (empty($khachHang)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Thêm hoá đơn bán thất bại, khách hàng không tồn tại!',
                    'data' => null
                ]);
            }
        }
        return SCRole::unauthorized();
    }

    public function show($id)
    {
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên thu ngân')) {
            $hoaDonBan = HoaDonBan::find($id);
            if (!empty($hoaDonBan)) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy hoá đơn bán thành công!',
                    'data' => $hoaDonBan
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Lấy hoá đơn bán thất bại, không tìm thấy hoá đơn bán theo theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function update(Request $request, $id)
    {
        $updateHoaDonBanRequest = new UpdateHoaDonBanRequest;
        $validation = Validator::make($request->all(), $updateHoaDonBanRequest->rules(), $updateHoaDonBanRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên thu ngân')) {
            $hoaDonBan = HoaDonBan::find($id);
            if (!empty($thucUong)) {
                if (isset($request->nhan_vien_id)) {
                    $nhanVien = NhanVien::find($request->nhan_vien_id);
                    if (!empty($nhanVien)) {
                        $hoaDonBan->nhan_vien_id = $request->nhan_vien_id;
                    }
                    else {
                        return response()->json([
                            'code' => 400,
                            'message' => 'Thêm hoá đơn bán thất bại, nhân viên không tồn tại!',
                            'data' => $hoaDonBan
                        ]);
                    }
                }
                if (isset($request->khach_hang_id)) {
                    $khachHang = KhachHang::find($request->khach_hang_id);
                    if (!empty($khachHang)) {
                        $hoaDonBan->khach_hang_id = $request->khach_hang_id;
                    }
                    else {
                        return response()->json([
                            'code' => 400,
                            'message' => 'Thêm hoá đơn bán thất bại, khách hàng không tồn tại!',
                            'data' => $hoaDonBan
                        ]);
                    }
                }
                $hoaDonBan->ngay = Carbon::now();
                if (isset($request->tong_tien)) {
                    $hoaDonBan->tong_tien = $request->tong_tien;
                }
                if (isset($request->diem)) {
                    $hoaDonBan->diem = $request->diem;
                }
                if (isset($request->trang_thai)) {
                    $hoaDonBan->trang_thai = $request->trang_thai;
                }
                $hoaDonBan->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Cập nhật hoá đơn bán thành công!',
                    'data' => $hoaDonBan
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Cập nhật hoá đơn bán thất bạị, không tìm thấy hoá đơn bán theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function destroy($id)
    {
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $hoaDonBan = HoaDonBan::find($id);
            if (!empty($hoaDonBan)) {
                $hoaDonBan->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'Xoá hoá đơn bán thành công!',
                    'data' => $hoaDonBan
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Xoá hoá đơn bán thất bại, không tìm thấy hoá đơn bán theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
