<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\LoaiThucUong;

class ThucUong extends Model
{
    use SoftDeletes;
    protected $table = 'thuc_uong';
    protected $hidden = ['hinh_anh', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['loai_thuc_uong_id', 'ten', 'gia', 'hinh_anh'];
    protected $appends = ['ten_loai', 'duong_dan_hinh_anh'];

    public function loaiThucUong()
    {
        return $this->belongsTo('App\LoaiThucUong');
    }

    public function danhSachHoaDonBan()
    {
        return $this->belongsToMany('App\HoaDonBan', 'chi_tiet_hoa_don_ban');
    }

    public function getDuongDanHinhAnhAttribute()
    {
        if ($this->hinh_anh) {
            return request()->getSchemeAndHttpHost() . "/storage/thuc-uong/" . $this->hinh_anh;
        }
        return null;
    }

    public function getTenLoaiAttribute()
    {
        $loaiThucUong = LoaiThucUong::withTrashed()->find($this->loai_thuc_uong_id);
        if (!empty($loaiThucUong)) {
            return $loaiThucUong->ten;
        }
        return $loaiThucUong;
    }
}