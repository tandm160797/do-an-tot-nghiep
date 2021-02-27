<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LichSuChinhSuaSoLuongNguyenLieu;

class LichSuChinhSuaSoLuongNguyenLieuController extends Controller
{
    public function list($page)
    {
        if ($page >= 1) {
            $danhSachLichSuChinhSuaSoLuongNguyenLieu = LichSuChinhSuaSoLuongNguyenLieu::offset(($page - 1) * 10)
                                                ->limit(10)
                                                ->get();
            if (count($danhSachLichSuChinhSuaSoLuongNguyenLieu) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách lịch sử chỉnh sửa nguyên liệu thành công!',
                    'data' => $danhSachLichSuChinhSuaSoLuongNguyenLieu
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Danh sách lịch sử chỉnh sửa nguyên liệu rỗng!',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Số trang không hợp lệ!',
            'data' => null
        ]);
    }   
}
