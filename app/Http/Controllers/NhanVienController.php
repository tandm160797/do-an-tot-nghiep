<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NhanVien\Requesst;
use App\Http\Requests\NhanVien\Ajax\CheckFullNameRequest;
use App\Http\Requests\NhanVien\Ajax\CheckUsernameRequest;
use App\Http\Requests\NhanVien\Ajax\CheckPasswordRequest;
use App\Http\Requests\NhanVien\Ajax\CheckEmailRequest;
use App\Http\Requests\NhanVien\Ajax\CheckPhoneNumberRequest;
use App\Http\Requests\NhanVien\UpdateFullNameRequest;
use App\Http\Requests\NhanVien\UpdateEmailRequest;
use App\Http\Requests\NhanVien\UpdatePhoneNumberRequest;
use App\Http\Requests\NhanVien\UpdateAvatarRequest;
use App\Http\Requests\NhanVien\ChangePasswordRequest;
use App\Http\Requests\NhanVien\ResetPasswordRequest;
use App\Http\Requests\NhanVien\ForgotPasswordRequest;
use App\Http\Requests\NhanVien\RegisterRequest;
use App\Http\Requests\NhanVien\UpdateRequest;
use Illuminate\Support\Facades\Validator;
use App\NhanVien;
use App\HoaDonBan;
use App\HoaDonNhap;
use App\ChiTietHoaDonBan;
use App\ChiTietHoaDonNhap;
use App\LichSuDiem;
use App\NguyenLieu;
use App\LoaiNhanVien;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Helpers\SCMail;
use App\Helpers\SCImage;
use DB;

class NhanVienController extends Controller
{
    public function a(Request $request)
    {
        return SCImage::upload($request->hinh_anh, 'thuc-uong', 300);
    }

    public function register(Request $request)
    {
        $registerRequest = new RegisterRequest;
        $validation = Validator::make($request->all(), $registerRequest->rules(), $registerRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $khachHang = new NhanVien;
        $khachHang->ten_dang_nhap = $request->ten_dang_nhap;
        $khachHang->mat_khau = Hash::make($request->mat_khau);
        $khachHang->ho_ten = $request->ho_ten;
        $khachHang->loai_nhan_vien_id = $request->loai_nhan_vien_id;
        $khachHang->save();
        return response()->json([
            'code' => 200,
            'message' => 'Đăng ký tài khoản thành công!'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = [
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'password' => $request->mat_khau
        ];

        if($token = auth('nhan_vien')->attempt($credentials)) {
            return response()->json([
                'code' => 200,
                'message' => 'Đăng nhập thành công!',
                'data' => $token
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác!',
            'data' => null
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $forgotPasswordRequest = new ForgotPasswordRequest;
        $validation = Validator::make($request->all(), $forgotPasswordRequest->rules(), $forgotPasswordRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $nhanVien = NhanVien::where('ten_dang_nhap', $request->ten_dang_nhap)->first();
        if (!empty($nhanVien)) {
            if ($nhanVien->email) {
                $otp = rand(1000, 9999);
                $nhanVien->update(['otp' => $otp]);
                $data = ['otp' => $otp];
                if (SCMail::send($nhanVien, $data)) {
                    return response()->json([
                        'code' => 200,
                        'message' => 'Đã gửi otp đến ' . $nhanVien->email . ', vui lòng kiểm tra email để lấy lại mật khẩu!',
                        'data' => $nhanVien->id
                    ]);
                }
            }
            return response()->json([
                'code' => 400,
                'message' => 'Tài khoản chưa được cập nhật email!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Tên đăng nhập không tồn tại!'
        ]);
    }

    public function resetPassword(Request $request, $id)
    {
        $resetPasswordRequest = new ResetPasswordRequest;
        $validation = Validator::make($request->all(), $resetPasswordRequest->rules(), $resetPasswordRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        $nhanVien = NhanVien::find($id);
        if (!empty($nhanVien)) {
            $now = date('Y-m-d H:i:s');
            $difference = abs(strtotime($now) - strtotime($nhanVien->updated_at));
            if ($difference <= 200) {
                if ($request->otp === $nhanVien->otp) {
                    $nhanVien->update(['mat_khau' => Hash::make($request->mat_khau), 'otp' => null]);
                    return response()->json([
                        'code' => 200,
                        'message' => 'Lấy lại mật khẩu thành công!'
                    ]);
                }
                return response()->json([
                    'code' => 400,
                    'message' => 'Mã otp không hợp lệ!'
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Mã otp đã hết hạn!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Nhân viên không tồn tại!'
        ]);
    }

    //
    public function info(Request $request)
    {
        return response()->json([
            'code' => 200,
            'message' => 'Lấy thông tin nhân viên thành công!',
            'data' => auth()->user()
        ]);
    }

    public function changePassword(Request $request)
    {
        $changePasswordRequest = new ChangePasswordRequest;
        $validation = Validator::make($request->all(), $changePasswordRequest->rules(), $changePasswordRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        auth()->user()->update(['mat_khau' => Hash::make($request->mat_khau)]);
        return response()->json([
            'code' => 200,
            'message' => 'Đổi mật khẩu thành công!'
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json([
            'code' => 200,
            'message' => 'Đăng xuất thành công!'
        ]);
    }
    //

    public function updateFullName(Request $request)
    {
        $updateFullNameRequest = new UpdateFullNameRequest;
        $validation = Validator::make($request->all(), $updateFullNameRequest->rules(), $updateFullNameRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        auth()->user()->update(['ho_ten' => $request->ho_ten]);
        return response()->json([
            'code' => 200,
            'message' => 'Cập nhật họ tên thành công!'
        ]);
    }

    public function updateEmail(Request $request)
    {
        $updateEmailRequest = new UpdateEmailRequest;
        $validation = Validator::make($request->all(), $updateEmailRequest->rules(), $updateEmailRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        auth()->user()->update(['email' => $request->email]);
        return response()->json([
            'code' => 200,
            'message' => 'Cập nhật email thành công!'
        ]);
    }

    public function updatePhoneNumber(Request $request)
    {
        $updatePhoneNumberRequest = new UpdatePhoneNumberRequest;
        $validation = Validator::make($request->all(), $updatePhoneNumberRequest->rules(), $updatePhoneNumberRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        auth()->user()->update(['so_dien_thoai' => $request->so_dien_thoai]);
        return response()->json([
            'code' => 200,
            'message' => 'Cập nhật số điện thoại thành công!'
        ]);
    }

    public function updateAvatar(Request $request)
    {
        $updateAvatarRequest = new UpdateAvatarRequest;
        $validation = Validator::make($request->all(), $updateAvatarRequest->rules(), $updateAvatarRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        //
        if ($request->hasFile('anh_dai_dien')) {
            if (auth()->user()->anh_dai_dien) {
                SCImage::delete('khach-hang', auth()->user()->anh_dai_dien);
            }
            auth()->user()->update(['anh_dai_dien' => SCImage::upload($request->anh_dai_dien, 'nhan-vien', 300)]);
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật ảnh đại diện thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Không tìm thấy ảnh!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $updateAvatarRequest = new UpdateRequest;
        $validation = Validator::make($request->all(), $updateAvatarRequest->rules(), $updateAvatarRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
        //
        $nhanVien = NhanVien::find($id);
        if (!empty($nhanVien)) {
            $nhanVien->update(['loai_nhan_vien_id' => $request->loai_nhan_vien_id]);
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật thành công!'
            ]);
        }
    }

    //
    public function followOrder($page)
    {
        if ($page >= 1) {
            $danhSachHoaDon = HoaDonBan::where('trang_thai', 'Đã đặt')
                                        ->orWhere('trang_thai', 'Đã nhận')
                                        ->orderBy('id', 'DESC')
                                        ->offset(($page - 1) * 10)
                                        ->limit(10)
                                            ->get();
            if (count($danhSachHoaDon) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách đặt hàng thành công!',
                    'data' => $danhSachHoaDon
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Chưa có đơn hàng mới!',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Số trang không hợp lệ!',
            'data' => null
        ]);
    }

    public function detailOrder($hoaDonBanId)
    {
        $chiTietHoaDonBan = ChiTietHoaDonBan::where('hoa_don_ban_id', $hoaDonBanId)->get();
        if (count($chiTietHoaDonBan) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy chi tiết đơn hàng thành công!',
                'data' => $chiTietHoaDonBan
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Đơn hàng không hợp lệ!',
            'data' => null
        ]);
    }

    public function receiveOrder($id)
    {
        $hoaDonBan = HoaDonBan::find($id);
        if (!empty($hoaDonBan)) {
            if ($hoaDonBan->trang_thai == 'Đã đặt') {
                $hoaDonBan->update(['trang_thai' => 'Đã nhận', 'nhan_vien_id' => auth()->user()->id]);
                return response()->json([
                    'code' => 200,
                    'message' => 'Nhận đơn hàng thành công!'
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Đơn hàng không hợp lệ!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Đơn hàng không tồn tại!'
        ]);
    }

    public function delivereOrder(Request $request, $id)
    {
        $hoaDonBan = HoaDonBan::find($id);
        if (!empty($hoaDonBan)) {
            if ($hoaDonBan->trang_thai == 'Đã nhận') {
                if ((int)$request->diem <= $hoaDonBan->khach_hang->diem) {
                    $hoaDonBan->update(['trang_thai' => 'Đã giao', 'nhan_vien_id' => auth()->user()->id]);
                    $hoaDonBan->khach_hang->update(['diem' => $hoaDonBan->khach_hang->diem - (int)$request->diem + $hoaDonBan->diem]);
                    if ((int)$request->diem > 0) {
                        $lichSuDiem = new LichSuDiem;
                        $lichSuDiem->khach_hang_id = $hoaDonBan->khach_hang->id;
                        $lichSuDiem->ngay = Carbon::now();
                        $lichSuDiem->diem = (int)$request->diem;
                        $lichSuDiem->ghi_chu = "Thanh toán cho HD" . $hoaDonBan->id;
                        $lichSuDiem->save();
                    }
                    return response()->json([
                        'code' => 200,
                        'message' => 'Thanh toán đơn hàng thành công!'
                    ]);
                }
                return response()->json([
                    'code' => 400,
                    'message' => 'Khách hàng không đủ điểm để thanh toán!'
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Đơn hàng không hợp lệ!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Đơn hàng không tồn tại!'
        ]);
    }

    public function cancelOrder($id)
    {
        $hoaDonBan = HoaDonBan::find($id);
        if (!empty($hoaDonBan)) {
            if ($hoaDonBan->trang_thai == 'Đã đặt') {
                $hoaDonBan->update(['trang_thai' => 'Đã hủy', 'nhan_vien_id' => auth()->user()->id]);
                return response()->json([
                    'code' => 200,
                    'message' => 'Hủy đơn hàng thành công!'
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Đơn hàng không hợp lệ!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Đơn hàng không tồn tại!'
        ]);
    }
    
    public function importMaterials(Request $request)
    {
        $gioHangs = json_decode($request->danh_sach_nguyen_lieu);
        $hoaDonNhap = new HoaDonNhap;
        $tongTien = 0;
        foreach ($gioHangs as $gioHang) {
            $tongTien += ($gioHang->so_luong * $gioHang->nguyen_lieu->gia);
        }
        $hoaDonNhap->nhan_vien_id = auth()->user()->id;
        $hoaDonNhap->ngay = Carbon::now();
        $hoaDonNhap->tong_tien = $tongTien;
        $hoaDonNhap->save();
        foreach ($gioHangs as $gioHang) {
            $chiTietHoaDonNhap = new ChiTietHoaDonNhap;
            $chiTietHoaDonNhap->hoa_don_nhap_id = $hoaDonNhap->id;
            $chiTietHoaDonNhap->nguyen_lieu_id = $gioHang->nguyen_lieu->id;
            $chiTietHoaDonNhap->so_luong = $gioHang->so_luong;
            $chiTietHoaDonNhap->gia = $gioHang->nguyen_lieu->gia;
            $chiTietHoaDonNhap->save();
            //
            $nguyenLieu = NguyenLieu::find($gioHang->nguyen_lieu->id);
            $nguyenLieu->update(['so_luong_ton' => $nguyenLieu->so_luong_ton + $gioHang->so_luong]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'Nhập kho thành công!'
        ]);
    }

    //
    public function list()
    {
        $loaiNhanVienAdmin = LoaiNhanVien::where('ten', "Admin")->first();
        $danhSachNhanVien = NhanVien::where('loai_nhan_vien_id', "!=", $loaiNhanVienAdmin->id)->get();
        if (count($danhSachNhanVien) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy danh sách nhân viên thành công!',
                'data' => $danhSachNhanVien
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Danh sách nhân viên rỗng!',
            'data' => null
        ]);
    }

    public function delete($id)
    {
        $nhanVien = NhanVien::find($id);
        if (!empty($nhanVien)) {
            $nhanVien->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xoá nhân viên thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Nhân viên không tồn tại!'
        ]);
    }

    //
    public function checkFullName(Request $request)
    {
        $checkFullNameRequest = new CheckFullNameRequest;
        $validation = Validator::make($request->all(), $checkFullNameRequest->rules(), $checkFullNameRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }

    public function checkUsername(Request $request)
    {
        $checkUsernameRequest = new CheckUsernameRequest;
        $validation = Validator::make($request->all(), $checkUsernameRequest->rules(), $checkUsernameRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }

    public function checkPassword(Request $request)
    {
        $checkPasswordRequest = new CheckPasswordRequest;
        $validation = Validator::make($request->all(), $checkPasswordRequest->rules(), $checkPasswordRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }

    public function checkEmail(Request $request)
    {
        $checkEmailRequest = new CheckEmailRequest;
        $validation = Validator::make($request->all(), $checkEmailRequest->rules(), $checkEmailRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }

    public function checkPhoneNumber(Request $request)
    {
        $checkPhoneNumberRequest = new CheckPhoneNumberRequest;
        $validation = Validator::make($request->all(), $checkPhoneNumberRequest->rules(), $checkPhoneNumberRequest->messages());
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->messages()->first()
            ]);
        }
    }
    // Thống kê
    public function sumCollect($month)
    {
        $currentDate = date("Y-m-d");
        $timestamp = strtotime($currentDate);
        $year = date('Y', $timestamp);
        //
        $hoaDonBan = DB::table('hoa_don_ban')
                    ->selectRaw('sum(tong_tien) as tong_thu')
                    ->whereMonth('ngay', $month)
                    ->whereYear('ngay', $year)
                    ->where('trang_thai', 'Đã giao')
                    ->first();
        return response()->json([
            'code' => 200,
            'message' => 'Lấy tổng thu thành công!',
            'data' => (int)$hoaDonBan->tong_thu
        ]);
    }

    public function sumSpending($month)
    {
        $currentDate = date("Y-m-d");
        $timestamp = strtotime($currentDate);
        $year = date('Y', $timestamp);
        //
        $hoaDonNhap = DB::table('hoa_don_nhap')
                    ->selectRaw('sum(tong_tien) as tong_chi')
                    ->whereMonth('ngay', $month)
                    ->whereYear('ngay', $year)
                    ->first();
        return response()->json([
            'code' => 200,
            'message' => 'Lấy tổng chi thành công!',
            'data' => (int)$hoaDonNhap->tong_chi
        ]);
    }

    public function sumProfit($month)
    {
        $currentDate = date("Y-m-d");
        $timestamp = strtotime($currentDate);
        $year = date('Y', $timestamp);
        //
        $hoaDonBan = DB::table('hoa_don_ban')
                    ->selectRaw('sum(tong_tien) as tong_thu')
                    ->whereMonth('ngay', $month)
                    ->whereYear('ngay', $year)
                    ->where('trang_thai', 'Đã giao')
                    ->first();
        //
        $hoaDonNhap = DB::table('hoa_don_nhap')
                    ->selectRaw('sum(tong_tien) as tong_chi')
                    ->whereMonth('ngay', $month)
                    ->whereYear('ngay', $year)
                    ->first();
        return response()->json([
            'code' => 200,
            'message' => 'Lấy tổng lợi nhuận thành công!',
            'data' => (int)$hoaDonBan->tong_thu - (int)$hoaDonNhap->tong_chi
        ]);
    }

    public function collectChart($dayQty)
    {
        if ($dayQty > 90 || $dayQty < 1) {
            return response()->json([
                'code' => 400,
                'message' => 'Chỉ giới hạn số ngày từ 1 - 90!',
                'data' => null
            ]);
        }
        $currentDate = date("Y-m-d");
        $timestampCurrentDate = strtotime($currentDate);
        $timestampOneDay = 24 * 60 * 60;
        $condition = $timestampCurrentDate - $timestampOneDay * $dayQty;
        $chart = [];
        //
        while($timestampCurrentDate > $condition) {
            $day = date('d', $timestampCurrentDate);
            $month = date('m', $timestampCurrentDate);
            $year = date('Y', $timestampCurrentDate);
            $hoaDonBan = DB::table('hoa_don_ban')
                        ->selectRaw('sum(tong_tien) as tong_thu')
                        ->whereDay('ngay', $day)
                        ->whereMonth('ngay', $month)
                        ->whereYear('ngay', $year)
                        ->where('trang_thai', 'Đã giao')
                        ->first();
            //
            if ($hoaDonBan->tong_thu) {
                array_push($chart, (int)$hoaDonBan->tong_thu);
            }
            else {
                array_push($chart, 0);
            }
            $timestampCurrentDate -= $timestampOneDay;
        }
        return response()->json([
            'code' => 200,
            'message' => 'Lấy biểu đồ thu thành công!',
            'data' => $chart
        ]);
    }
}