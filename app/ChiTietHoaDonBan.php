<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ThucUong;

class ChiTietHoaDonBan extends Model
{
    use SoftDeletes;
    protected $table = 'chi_tiet_hoa_don_ban';
    protected $hidden = ['thuc_uong_id', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['hoa_don_ban_id', 'thuc_uong_id', 'so_luong', 'gia'];
    protected $appends = ['thuc_uong'];

    public function hoaDonBan()
    {
        return $this->belongsTo('App\HoaDonBan');
    }

    public function getThucUongAttribute()
    {
        $thucUong = ThucUong::withTrashed()->find($this->thuc_uong_id);
        if (!empty($thucUong)) {
            return $thucUong;
        }
        return null;
    }
}
