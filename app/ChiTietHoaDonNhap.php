<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietHoaDonNhap extends Model
{
    use SoftDeletes;
    protected $table = 'chi_tiet_hoa_don_nhap';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['hoa_don_nhap_id', 'nguyen_lieu_id', 'so_luong', 'gia'];

    public function hoaDonNhap()
    {
        return $this->belongsTo('App\HoaDonNhap');
    }
}
