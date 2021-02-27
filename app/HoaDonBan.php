<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\KhachHang;

class HoaDonBan extends Model
{
    use SoftDeletes;
    protected $table = 'hoa_don_ban';
    protected $hidden = ['khach_hang_id', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['nhan_vien_id', 'khach_hang_id', 'ngay', 'tong_tien', 'diem', 'trang_thai'];
    protected $appends = ['khach_hang'];

    public function nhanVien()
    {
        return $this->belongsTo('App\NhanVien');
    }

    public function khachHang()
    {
        return $this->belongsTo('App\KhachHang');
    }

    public function danhSachThucUong()
    {
        return $this->belongsToMany('App\ThucUong', 'chi_tiet_hoa_don_ban');
    }

    public function getKhachHangAttribute()
    {
        $khachHang = KhachHang::withTrashed()->find($this->khach_hang_id);
        if (!empty($khachHang)) {
            return $khachHang;
        }
        return null;
    }
}
