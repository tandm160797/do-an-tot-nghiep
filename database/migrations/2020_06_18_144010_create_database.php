<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration
{
    public function up()
    {
        Schema::create('loai_nhan_vien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('loai_thuc_uong', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten')->nullable();
            $table->string('anh_dai_dien');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('nhan_vien', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('loai_nhan_vien_id');
            $table->string('ten_dang_nhap')->nullable();
            $table->string('mat_khau')->nullable();
            $table->string('otp')->nullable();
            $table->string('ho_ten')->nullable();
            $table->string('email')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->string('anh_dai_dien')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('khach_hang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_dang_nhap')->nullable();
            $table->string('mat_khau')->nullable();
            $table->string('otp')->nullable();
            $table->string('ho_ten')->nullable();
            $table->string('email')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->string('anh_dai_dien')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('dia_chi')->nullable();
            $table->unsignedInteger('diem')->default(10000);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('lich_su_diem', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('khach_hang_id');
            $table->date('ngay')->nullable();
            $table->unsignedInteger('diem')->nullable();
            $table->string('ghi_chu')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('nguyen_lieu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten')->nullable();
            $table->string('don_vi_tinh')->nullable();
            $table->unsignedInteger('so_luong_ton')->nullable();
            $table->unsignedInteger('gia')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('thuc_uong', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('loai_thuc_uong_id');
            $table->string('ten')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->unsignedInteger('gia')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('hoa_don_nhap', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nhan_vien_id');
            $table->date('ngay')->nullable();
            $table->unsignedInteger('tong_tien')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('hoa_don_ban', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nhan_vien_id')->nullable();
            $table->unsignedInteger('khach_hang_id');
            $table->date('ngay')->nullable();
            $table->unsignedInteger('tong_tien')->nullable();
            $table->unsignedInteger('diem')->nullable();
            $table->string('trang_thai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('chi_tiet_hoa_don_nhap', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hoa_don_nhap_id');
            $table->unsignedInteger('nguyen_lieu_id');
            $table->unsignedInteger('so_luong')->nullable();
            $table->unsignedInteger('gia')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('chi_tiet_hoa_don_ban', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hoa_don_ban_id');
            $table->unsignedInteger('thuc_uong_id');
            $table->unsignedInteger('so_luong')->nullable();
            $table->unsignedInteger('gia')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('lich_su_chinh_sua_so_luong_nguyen_lieu', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nhan_vien_id')->nullable();
            $table->unsignedInteger('nguyen_lieu_id')->nullable();
            $table->unsignedInteger('so_luong_cu')->nullable();
            $table->unsignedInteger('so_luong_moi')->nullable();
            $table->date('ngay')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loai_nhan_vien');
        Schema::dropIfExists('loai_thuc_uong');
        Schema::dropIfExists('nhan_vien');
        Schema::dropIfExists('khach_hang');
        Schema::dropIfExists('lich_su_diem');
        Schema::dropIfExists('nguyen_lieu');
        Schema::dropIfExists('thuc_uong');
        Schema::dropIfExists('hoa_don_nhap');
        Schema::dropIfExists('hoa_don_ban');
        Schema::dropIfExists('chi_tiet_hoa_don_nhap');
        Schema::dropIfExists('chi_tiet_hoa_don_ban');
    }
}
