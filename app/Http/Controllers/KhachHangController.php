<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\KhachHang\Requesst;
use App\Http\Requests\KhachHang\Ajax\CheckFullNameRequest;
use App\Http\Requests\KhachHang\Ajax\CheckUsernameRequest;
use App\Http\Requests\KhachHang\Ajax\CheckPasswordRequest;
use App\Http\Requests\KhachHang\Ajax\CheckEmailRequest;
use App\Http\Requests\KhachHang\Ajax\CheckPhoneNumberRequest;
use App\Http\Requests\KhachHang\RegisterRequest;
use App\Http\Requests\KhachHang\UpdateFullNameRequest;
use App\Http\Requests\KhachHang\UpdateEmailRequest;
use App\Http\Requests\KhachHang\UpdatePhoneNumberRequest;
use App\Http\Requests\KhachHang\UpdateAvatarRequest;
use App\Http\Requests\KhachHang\ChangePasswordRequest;
use App\Http\Requests\KhachHang\ResetPasswordRequest;
use App\Http\Requests\KhachHang\ForgotPasswordRequest;
use Illuminate\Support\Facades\Validator;
use App\KhachHang;
use App\HoaDonBan;
use App\ChiTietHoaDonBan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Helpers\SCMail;
use App\Helpers\SCImage;

class KhachHangController extends Controller
{
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
        $khachHang = new KhachHang;
        $khachHang->ten_dang_nhap = $request->ten_dang_nhap;
        $khachHang->mat_khau = Hash::make($request->mat_khau);
        $khachHang->ho_ten = $request->ho_ten;
        $khachHang->facebook_id = $request->facebook_id;
        $khachHang->dia_chi = $request->dia_chi;
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

        if($token = auth('khach_hang')->attempt($credentials)) {
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
        $khachHang = KhachHang::where('ten_dang_nhap', $request->ten_dang_nhap)->first();
        if (!empty($khachHang)) {
            if ($khachHang->email) {
                $otp = rand(1000, 9999);
                $khachHang->update(['otp' => $otp]);
                $data = ['otp' => $otp];
                if (SCMail::send($khachHang, $data)) {
                    return response()->json([
                        'code' => 200,
                        'message' => 'Đã gửi otp đến ' . $khachHang->email . ', vui lòng kiểm tra email để lấy lại mật khẩu!',
                        'data' => $khachHang->id
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
        $khachHang = KhachHang::find($id);
        if (!empty($khachHang)) {
            $now = date('Y-m-d H:i:s');
            $difference = abs(strtotime($now) - strtotime($khachHang->updated_at));
            if ($difference <= 200) {
                if ($request->otp === $khachHang->otp) {
                    $khachHang->update(['mat_khau' => Hash::make($request->mat_khau), 'otp' => null]);
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
            'message' => 'Khách hàng không tồn tại!'
        ]);
    }

    //
    public function info(Request $request)
    {
        return response()->json([
            'code' => 200,
            'message' => 'Lấy thông tin khách hàng thành công!',
            'data' => auth()->user()
        ]);
    }

    public function infoByFacebookId(Request $request)
    {
        $khachHang = KhachHang::where('facebook_id', $request->facebook_id)->first();
        if (!empty($khachHang)) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy thông tin khách hàng thành công!',
                'data' => $khachHang
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Facebook id không tồn tại!',
            'data' => null
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
            auth()->user()->update(['anh_dai_dien' => SCImage::upload($request->anh_dai_dien, 'khach-hang', 300)]);
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

    //
    public function order(Request $request)
    {
        $gioHangs = json_decode($request->danh_sach_thuc_uong);
        $hoaDonBan = new HoaDonBan;
        $tongTien = 0;
        foreach ($gioHangs as $gioHang) {
            $tongTien += ($gioHang->so_luong * $gioHang->thuc_uong->gia);
        }
        $hoaDonBan->khach_hang_id = auth()->user()->id;
        $hoaDonBan->ngay = Carbon::now();
        $hoaDonBan->tong_tien = $tongTien;
        $hoaDonBan->diem = 0.1 * $tongTien;
        $hoaDonBan->trang_thai = "Đã đặt";
        $hoaDonBan->save();
        foreach ($gioHangs as $gioHang) {
            $chiTietHoaDonBan = new ChiTietHoaDonBan;
            $chiTietHoaDonBan->hoa_don_ban_id = $hoaDonBan->id;
            $chiTietHoaDonBan->thuc_uong_id = $gioHang->thuc_uong->id;
            $chiTietHoaDonBan->so_luong = $gioHang->so_luong;
            $chiTietHoaDonBan->gia = $gioHang->thuc_uong->gia;
            $chiTietHoaDonBan->save();
        }
        return response()->json([
            'code' => 200,
            'message' => 'Đặt hàng thành công, vui lòng theo dõi đơn hàng!'
        ]);
    }
    
    public function followOrder($page)
    {
        if ($page >= 1) {
            $danhSachHoaDon = HoaDonBan::where('khach_hang_id', auth()->user()->id)
                                            ->orderBy('id', 'DESC')
                                            ->offset(($page - 1) * 10)
                                            ->limit(10)
                                            ->get();
            if (count($danhSachHoaDon) > 0) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Lấy danh sách lịch sử đơn hàng thành công!',
                    'data' => $danhSachHoaDon
                ]);
            }
            return response()->json([
                'code' => 400,
                'message' => 'Khách hàng chưa có lịch sử đơn hàng!',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Số trang không hợp lệ!',
            'data' => null
        ]);
    }

    public function cancelOrder($id)
    {
        $hoaDonBan = HoaDonBan::find($id);
        if (!empty($hoaDonBan)) {
            if ($hoaDonBan->khach_hang_id == auth()->user()->id) {
                if ($hoaDonBan->trang_thai == 'Đã đặt') {
                    $hoaDonBan->update(['trang_thai' => 'Đã hủy']);
                    return response()->json([
                        'code' => 200,
                        'message' => 'Huỷ đơn hàng thành công!'
                    ]);
                }
                return response()->json([
                    'code' => 400,
                    'message' => 'Không thể huỷ đơn hàng đã được xử lý!'
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

    //
    public function list()
    {
        $danhSachKhachHang = KhachHang::get();
        if (count($danhSachKhachHang) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy danh sách khách hàng thành công!',
                'data' => $danhSachKhachHang
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Danh sách khách hàng rỗng!',
            'data' => null
        ]);
    }

    public function delete($id)
    {
        $khachHang = KhachHang::find($id);
        if (!empty($khachHang)) {
            $khachHang->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xoá khách hàng thành công!'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Khách hàng không tồn tại!'
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
    //
    public function listBestbuy($month)
    {
        $currentDate = date("Y-m-d");
        $timestamp = strtotime($currentDate);
        $year = date('Y', $timestamp);
        //
        $listBestbuy = HoaDonBan::selectRaw('khach_hang_id, count(khach_hang_id) as tong_so_lan')
                    ->whereMonth('ngay', $month)
                    ->whereYear('ngay', $year)
                    ->where('trang_thai', 'Đã giao')
                    ->groupBy('khach_hang_id')
                    ->orderByDesc('tong_so_lan')
                    ->take(10)
                    ->get();
        //
        if (count($listBestbuy) > 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Lấy danh sách nhân viên thành công!',
                'data' => $listBestbuy
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Danh sách nhân viên rỗng!',
            'data' => null
        ]);
    }
}