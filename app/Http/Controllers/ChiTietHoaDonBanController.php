<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreChiTietHoaDonBanRequest;
use App\Http\Requests\UpdateChiTietHoaDonBanRequest;
use Illuminate\Support\Facades\Validator;
use App\ChiTietHoaDonBan;
use App\HoaDonBan;
use App\ThucUong;
use App\Helpers\SCRole;

class ChiTietHoaDonBanController extends Controller
{
    public function index()
    {
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên thu ngân')) {
            $danhSachHoaDonBan = HoaDonBan::get();
            $danhSachChiTietHoaDonBan = ChiTietHoaDonBan::whereIn('hoa_don_ban_id', $danhSachHoaDonBan->modelKeys())->get();
            if (count($danhSachChiTietHoaDonBan) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách chi tiết hoá đơn bán thành công!',
                    'data' => $danhSachChiTietHoaDonBan
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Danh sách chi tiết hoá đơn bán rỗng!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function store(Request $request)
    {
        $storeChiTietHoaDonBanRequest = new StoreChiTietHoaDonBanRequest;
        $validation = Validator::make($request->all(), $storeChiTietHoaDonBanRequest->rules(), $storeChiTietHoaDonBanRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên thu ngân')) {
            $hoaDonBan = HoaDonBan::find($request->hoa_don_ban_id);
            $thucUong = ThucUong::find($request->thuc_uong_id);
            if (!empty($hoaDonBan) && !empty($thucUong)) {
                $chiTiethoaDonBan = new ChiTietHoaDonBan;
                $chiTiethoaDonBan->hoa_don_ban_id = $request->hoa_don_ban_id;
                $chiTiethoaDonBan->thuc_uong_id = $request->thuc_uong_id;
                $chiTiethoaDonBan->so_luong = $request->so_luong;
                $chiTiethoaDonBan->gia = $request->gia;
                $chiTiethoaDonBan->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Thêm chi tiết hoá đơn bán thành công!',
                    'data' => $chiTiethoaDonBan
                ]);
            }
            if (empty($hoaDonBan)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Thêm chi tiết hoá đơn bán thất bại, hoá đơn không tồn tại!',
                    'data' => null
                ]);
            }
            if (empty($thucUong)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Thêm chi tiết hoá đơn bán thất bại, thức uống không tồn tại!',
                    'data' => null
                ]);
            }
        }
        return SCRole::unauthorized();
    }

    public function show($id)
    {
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên thu ngân')) {
            $chiTiethoaDonBan = ChiTietHoaDonBan::find($id);
            if (!empty($chiTiethoaDonBan)) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy chi tiết hoá đơn bán thành công!',
                    'data' => $chiTiethoaDonBan
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Lấy chi tiết hoá đơn bán thất bại, không tìm thấy chi tiết hoá đơn bán theo theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function update(Request $request, $id)
    {
        $updateChiTietHoaDonBanRequest = new UpdateChiTietHoaDonBanRequest;
        $validation = Validator::make($request->all(), $updateChiTietHoaDonBanRequest->rules(), $updateChiTietHoaDonBanRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first(),
                'data' => null
            ]);
        }
        if (SCRole::isRoles(auth()->user(), 'Admin|Nhân viên thu ngân')) {
            $chiTiethoaDonBan = ChiTietHoaDonBan::find($id);
            if (!empty($chiTiethoaDonBan)) {
                if (isset($request->hoa_don_ban_id)) {
                    $hoaDonBan = HoaDonBan::find($request->hoa_don_ban_id);
                    if (!empty($hoaDonBan)) {
                        $chiTiethoaDonBan->hoa_don_ban_id = $request->hoa_don_ban_id;
                    }
                    else {
                        return response()->json([
                            'code' => 400,
                            'message' => 'Thêm chi tiết hoá đơn bán thất bại, hoá đơn không tồn tại!',
                            'data' => null
                        ]);
                    }
                }
                if (isset($request->thuc_uong_id)) {
                    $thucUong = ThucUong::find($request->thuc_uong_id);
                    if (!empty($thucUong)) {
                        $chiTiethoaDonBan->thuc_uong_id = $request->thuc_uong_id;
                    }
                    else {
                        return response()->json([
                            'code' => 400,
                            'message' => 'Thêm chi tiết hoá đơn bán thất bại, thức uống không tồn tại!',
                            'data' => null
                        ]);
                    }
                }
                if (isset($request->so_luong)) {
                    $chiTiethoaDonBan->so_luong = $request->so_luong;
                }
                if (isset($request->gia)) {
                    $chiTiethoaDonBan->gia = $request->gia;
                }
                $chiTiethoaDonBan->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'Cập nhật chi tiết hoá đơn bán thành công!',
                    'data' => $hoaDonNhap
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Cập nhật chi tiết hoá đơn bán thất bạị, không tìm thấy chi tiết hoá đơn bán theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }

    public function destroy($id)
    {
        if (SCRole::isRole(auth()->user(), 'Admin')) {
            $chiTiethoaDonBan = ChiTietHoaDonBan::find($id);
            if (!empty($chiTiethoaDonBan)) {
                $chiTiethoaDonBan->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'Xoá chi tiết hoá đơn bán thành công!',
                    'data' => $chiTiethoaDonBan
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Xoá chi tiết hoá đơn bán thất bại, không tìm thấy chi tiết hoá đơn bán theo yêu cầu!',
                'data' => null
            ]);
        }
        return SCRole::unauthorized();
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
