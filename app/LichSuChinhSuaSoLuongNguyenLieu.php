<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\NguyenLieu;
use App\NhanVien;

class LichSuChinhSuaSoLuongNguyenLieu extends Model
{
    use SoftDeletes;
    protected $table = 'lich_su_chinh_sua_so_luong_nguyen_lieu';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['nhan_vien_id', 'nguyen_lieu_id', 'so_luong_cu', 'so_luong_moi', 'ngay'];
    protected $appends = ['nguyen_lieu', 'nhan_vien'];
    //
    public function getNguyenLieuAttribute()
    {
        $nguyenLieu = NguyenLieu::withTrashed()->find($this->nguyen_lieu_id);
        if (!empty($nguyenLieu)) {
            return $nguyenLieu;
        }
        return null;
    }

    public function getNhanVienAttribute()
    {
        $nhanVien = NhanVien::withTrashed()->find($this->nhan_vien_id);
        if (!empty($nhanVien)) {
            return $nhanVien;
        }
        return null;
    }
}