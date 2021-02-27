<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class KhachHang extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    protected $table = 'khach_hang';
    protected $hidden = ['mat_khau', 'otp', 'anh_dai_dien', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['mat_khau', 'otp', 'ho_ten', 'email', 'so_dien_thoai', 'anh_dai_dien', 'diem', 'dia_chi'];
    protected $appends = ['duong_dan_anh_dai_dien'];
    
    public function lichSuDiem()
    {
        return $this->hasOne('App\LichSuDiem');        
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
            return request()->getSchemeAndHttpHost() . "/storage/khach-hang/" . $this->anh_dai_dien;
        }
        return null;
    }
}