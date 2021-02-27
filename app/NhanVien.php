<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Helpers\SCRole;

class NhanVien extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    protected $table = 'nhan_vien';
    protected $hidden = ['mat_khau', 'otp', 'anh_dai_dien', 'loai_nhan_vien_id', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['loai_nhan_vien_id', 'mat_khau', 'otp', 'ho_ten', 'email', 'so_dien_thoai', 'anh_dai_dien'];
    protected $appends = ['duong_dan_anh_dai_dien', 'loai_nhan_vien'];
    
    public function loaiNhanVien()
    {
        return $this->belongsTo('App\LoaiNhanVien');
    }

    public function danhSachHoaDonNhap()
    {
        return $this->hasMany('App\HoaDonNhap');
    }

    public function danhSachHoaDonBan()
    {
        return $this->hasMany('App\HoaDonBan');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getPasswordAttribute()
    {
        return $this->mat_khau;
    }

    public function getDuongDanAnhDaiDienAttribute()
    {
        if ($this->anh_dai_dien) {
            return request()->getSchemeAndHttpHost() . "/storage/nhan-vien/" . $this->anh_dai_dien;
        }
        return null;
    }

    public function getLoaiNhanVienAttribute()
    {
        return SCRole::getRoleName($this);
    }
}
