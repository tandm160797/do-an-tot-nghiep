<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKey extends Migration
{
    public function up()
    {
        Schema::table('nhan_vien', function (Blueprint $table) {
            $table->foreign('loai_nhan_vien_id')->references('id')->on('loai_nhan_vien');
        });
        Schema::table('lich_su_diem', function (Blueprint $table) {
            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
        });
        Schema::table('thuc_uong', function (Blueprint $table) {
            $table->foreign('loai_thuc_uong_id')->references('id')->on('loai_thuc_uong');
        });
        Schema::table('hoa_don_nhap', function (Blueprint $table) {
            $table->foreign('nhan_vien_id')->references('id')->on('nhan_vien');
        });
        Schema::table('hoa_don_ban', function (Blueprint $table) {
            $table->foreign('nhan_vien_id')->references('id')->on('nhan_vien');
            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
        });
        Schema::table('chi_tiet_hoa_don_nhap', function (Blueprint $table) {
            $table->foreign('hoa_don_nhap_id')->references('id')->on('hoa_don_nhap');
            $table->foreign('nguyen_lieu_id')->references('id')->on('nguyen_lieu');
        });
        Schema::table('chi_tiet_hoa_don_ban', function (Blueprint $table) {
            $table->foreign('hoa_don_ban_id')->references('id')->on('hoa_don_ban');
            $table->foreign('thuc_uong_id')->references('id')->on('thuc_uong');
        });
    }
}
