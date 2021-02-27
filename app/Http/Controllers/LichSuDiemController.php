<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LichSuDiem\StoreRequest;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\LichSuDiem;
use App\KhachHang;

class LichSuDiemController extends Controller
{
    public function list($page)
    {
        if ($page >= 1) {
            $danhSachLichSuDiem = LichSuDiem::where('khach_hang_id', auth()->user()->id)
                                                ->orderBy('id', 'DESC')
                                                ->offset(($page - 1) * 10)
                                                ->limit(10)
                                                ->get();
            if (count($danhSachLichSuDiem) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách lịch sử điểm thành công!',
                    'data' => $danhSachLichSuDiem
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Khách hàng chưa có lịch sử điểm!',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Số trang không hợp lệ!',
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
        $lichSuDiem = new LichSuDiem;
        $lichSuDiem->khach_hang_id = $request->khach_hang_id;
        $lichSuDiem->ngay = Carbon::now();
        $lichSuDiem->diem = $request->diem;
        $lichSuDiem->save();
        return response()->json([
            'code' => 200,
            'message' => 'Thêm lịch sử điểm thành công!'
        ]);
    }
}
