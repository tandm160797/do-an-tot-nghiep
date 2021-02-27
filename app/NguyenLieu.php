<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguyenLieu extends Model
{
    use SoftDeletes;
    protected $table = 'nguyen_lieu';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['ten', 'don_vi_tinh', 'so_luong_ton', 'gia'];

    public function danhSachHoaDonNhap()
    {
        return $this->belongsToMany('App\HoaDonNhap', 'chi_tiet_hoa_don_nhap');
    }
}
