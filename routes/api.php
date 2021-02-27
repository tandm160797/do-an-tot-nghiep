<?php

use Illuminate\Http\Request;

Route::post('/', 'NhanVienController@a');

// Nhân viên.
Route::prefix('/nhan-vien')->group(function () {
    Route::post('/dang-ky', 'NhanVienController@register');
    Route::post('/dang-nhap', 'NhanVienController@login');
    Route::post('/quen-mat-khau', 'NhanVienController@forgotPassword');
    Route::post('/dat-lai-mat-khau/{id}', 'NhanVienController@resetPassword');
    Route::post('/cap-nhat/{id}', 'NhanVienController@update');
    // Thống kê
    Route::get('/tong-thu/{month}', 'NhanVienController@sumCollect');
    Route::get('/tong-chi/{month}', 'NhanVienController@sumSpending');
    Route::get('/tong-loi-nhuan/{month}', 'NhanVienController@sumProfit');
    Route::get('/bieu-do-thu/{dayQty}', 'NhanVienController@collectChart');
    // Nhân viên cần token.
    Route::middleware(['assign.guard:nhan_vien', 'jwt.auth'])->group(function() {
        Route::post('thong-tin/', 'NhanVienController@info');
        Route::post('/doi-mat-khau', 'NhanVienController@changePassword');
        Route::post('/dang-xuat', 'NhanVienController@logout');
        // Cập nhật thông tin.
        Route::post('/cap-nhat-ho-ten', 'NhanVienController@updateFullName');
        Route::post('/cap-nhat-email', 'NhanVienController@updateEmail');
        Route::post('/cap-nhat-so-dien-thoai', 'NhanVienController@updatePhoneNumber');
        Route::post('/cap-nhat-anh-dai-dien', 'NhanVienController@updateAvatar');
        // Nhân viên thu ngân.
        Route::post('/theo-doi-don-hang/{page}', 'NhanVienController@followOrder');
        Route::post('/chi-tiet-don-hang/{hoaDonBanId}', 'NhanVienController@detailOrder');
        Route::post('/nhan-don-hang/{id}', 'NhanVienController@receiveOrder');
        Route::post('/giao-don-hang/{id}', 'NhanVienController@delivereOrder');
        Route::post('/huy-don-hang/{id}', 'NhanVienController@cancelOrder');
        // Nhân viên kho.
        Route::post('/nhap-kho', 'NhanVienController@importMaterials');
    });
    //
    Route::get('danh-sach/', 'NhanVienController@list');
    Route::post('xoa/{id}', 'NhanVienController@delete');
    // Kiểm tra dữ liệu.
    Route::post('/kiem-tra-ho-ten', 'NhanVienController@checkFullName');
    Route::post('/kiem-tra-ten-dang-nhap', 'NhanVienController@checkUsername');
    Route::post('/kiem-tra-mat-khau', 'NhanVienController@checkPassword');
    Route::post('/kiem-tra-email', 'NhanVienController@checkEmail');
    Route::post('/kiem-tra-so-dien-thoai', 'NhanVienController@checkPhoneNumber');
});

// Khách hàng.
Route::prefix('/khach-hang')->group(function () {
    Route::post('/dang-ky', 'KhachHangController@register');
    Route::post('/dang-nhap', 'KhachHangController@login');
    Route::post('/quen-mat-khau', 'KhachHangController@forgotPassword');
    Route::post('/dat-lai-mat-khau/{id}', 'KhachHangController@resetPassword');
    // Khách hàng cần token.
    Route::middleware(['assign.guard:khach_hang', 'jwt.auth'])->group(function() {
        Route::post('thong-tin/', 'KhachHangController@info');
        Route::post('/doi-mat-khau', 'KhachHangController@changePassword');
        Route::post('/dang-xuat', 'KhachHangController@logout');
         // Cập nhật thông tin.
        Route::post('/cap-nhat-ho-ten', 'KhachHangController@updateFullName');
        Route::post('/cap-nhat-email', 'KhachHangController@updateEmail');
        Route::post('/cap-nhat-so-dien-thoai', 'KhachHangController@updatePhoneNumber');
        Route::post('/cap-nhat-anh-dai-dien', 'KhachHangController@updateAvatar');
        //
        Route::post('/dat-hang', 'KhachHangController@order');
        Route::post('/theo-doi-don-hang/{page}', 'KhachHangController@followOrder');
        Route::post('/huy-don-hang/{id}', 'KhachHangController@cancelOrder');
    });
    //
    Route::post('thong-tin-bang-facebook-id/', 'KhachHangController@infoByFacebookId');
    Route::get('danh-sach/', 'KhachHangController@list');
    Route::post('xoa/{id}', 'KhachHangController@delete');
    // Kiểm tra dữ liệu.
    Route::post('/kiem-tra-ho-ten', 'KhachHangController@checkFullName');
    Route::post('/kiem-tra-ten-dang-nhap', 'KhachHangController@checkUsername');
    Route::post('/kiem-tra-mat-khau', 'KhachHangController@checkPassword');
    Route::post('/kiem-tra-email', 'KhachHangController@checkEmail');
    Route::post('/kiem-tra-so-dien-thoai', 'KhachHangController@checkPhoneNumber');
    //
    Route::get('/danh-sach-khach-hang-mua-nhieu/{month}', 'KhachHangController@listBestbuy');
});

// Loại nhân viên.
Route::prefix('/loai-nhan-vien')->group(function () {
    Route::get('/', 'LoaiNhanVienController@index');
    Route::post('/', 'LoaiNhanVienController@store');
    Route::get('/{id}', 'LoaiNhanVienController@show');
    Route::post('/{id}', 'LoaiNhanVienController@update');
    Route::post('/', 'LoaiNhanVienController@destroy');
});

// Loại thức uống.
Route::prefix('/loai-thuc-uong')->group(function () {
    Route::get('/danh-sach', 'LoaiThucUongController@list');
    Route::post('/them-moi', 'LoaiThucUongController@store');
    Route::post('/cap-nhat/{id}', 'LoaiThucUongController@update');
    Route::post('xoa/{id}', 'LoaiThucUongController@delete');
});

// Lịch sử điểm.
Route::prefix('/lich-su-diem')->group(function () {
    // Khách hàng cần token.
    Route::middleware(['assign.guard:khach_hang', 'jwt.auth'])->group(function() {
        Route::get('/danh-sach/{page}', 'LichSuDiemController@list');
    });
    //  
    Route::post('/them-moi', 'LichSuDiemController@store');
});

// Nguyên liệu.
Route::prefix('/nguyen-lieu')->group(function () {
    Route::get('/danh-sach/{page}', 'NguyenLieuController@list');
    Route::get('/danh-sach-xep-theo-so-luong-ton/{page}', 'NguyenLieuController@listSortByQuantityExists');
    Route::post('/danh-sach-theo-ten', 'NguyenLieuController@listByName');
    Route::post('/danh-sach-theo-so-luong-ton', 'NguyenLieuController@listByQuantityExists');
    Route::post('/danh-sach-theo-gia', 'NguyenLieuController@listByPrice');
    //
    Route::post('/them-moi', 'NguyenLieuController@store');
    Route::post('/xoa/{id}', 'NguyenLieuController@delete');
    //
    Route::post('/kiem-tra-ten-them-moi', 'NguyenLieuController@checkNameStore');
    Route::post('/kiem-tra-ten-cap-nhat', 'NguyenLieuController@checkNameUpdate');
    Route::post('/kiem-tra-so-luong-ton', 'NguyenLieuController@checkQuantityExists');
    Route::post('/kiem-tra-gia', 'NguyenLieuController@checkPrice');
    //
    Route::middleware(['assign.guard:nhan_vien', 'jwt.auth'])->group(function() {
        Route::post('/sua/{id}', 'NguyenLieuController@update');
    });
});

// Thức uống.
Route::prefix('/thuc-uong')->group(function () {
    Route::get('/danh-sach-theo-loai/{loaiThucUongId}', 'ThucUongController@listByType');
    Route::post('/them-moi', 'ThucUongController@store');
    Route::post('/cap-nhat/{id}', 'ThucUongController@update');
    Route::post('/cap-nhat-loai/{id}', 'ThucUongController@updateType');
    Route::post('/cap-nhat-ten/{id}', 'ThucUongController@updateName');
    Route::post('/cap-nhat-hinh-anh/{id}', 'ThucUongController@updateImage');
    Route::post('/cap-nhat-gia/{id}', 'ThucUongController@updatePrice');
    Route::post('/xoa/{id}', 'ThucUongController@delete');
    //
    Route::get('/danh-sach-thuc-uong-ban-chay/{month}', 'ThucUongController@listBestsell');
});

// Hoá đơn nhập.
Route::prefix('/hoa-don-nhap')->group(function () {
    Route::get('/', 'HoaDonNhapController@index');
    Route::post('/', 'HoaDonNhapController@store');
    Route::get('/{id}', 'HoaDonNhapController@show');
    Route::post('/{id}', 'HoaDonNhapController@update');
    Route::post('/', 'HoaDonNhapController@destroy');
});

// Hoá đơn bán.
Route::prefix('/hoa-don-ban')->group(function () {
    Route::get('/', 'HoaDonBanController@index');
    Route::post('/', 'HoaDonBanController@store');
    Route::get('/{id}', 'HoaDonBanController@show');
    Route::post('/{id}', 'HoaDonBanController@update');
    Route::post('/', 'HoaDonBanController@destroy');
});

// Chi tiết hoá đơn nhập.
Route::prefix('/chi-tiet-hoa-don-nhap')->group(function () {
    Route::get('/', 'ChiTietHoaDonNhapController@index');
    Route::post('/', 'ChiTietHoaDonNhapController@store');
    Route::get('/{id}', 'ChiTietHoaDonNhapController@show');
    Route::post('/{id}', 'ChiTietHoaDonNhapController@update');
    Route::post('/', 'ChiTietHoaDonNhapController@destroy');
});

// Chi tiết hoá đơn bán.
Route::prefix('/chi-tiet-hoa-don-ban')->group(function () {
    Route::get('/', 'ChiTietHoaDonBanController@index');
    Route::post('/', 'ChiTietHoaDonBanController@store');
    Route::get('/{id}', 'ChiTietHoaDonBanController@show');
    Route::post('/{id}', 'ChiTietHoaDonBanController@update');
    Route::post('/', 'ChiTietHoaDonBanController@destroy');
});

//
Route::prefix('/lich-su-chinh-sua-so-luong-nguyen-lieu')->group(function () {
    Route::get('/danh-sach/{page}', 'LichSuChinhSuaSoLuongNguyenLieuController@list');
});