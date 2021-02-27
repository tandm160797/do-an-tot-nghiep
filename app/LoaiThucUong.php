<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoaiThucUong extends Model
{
    use SoftDeletes;
    protected $table = 'loai_thuc_uong';
    protected $hidden = ['anh_dai_dien', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['ten', 'anh_dai_dien'];
    protected $appends = ['duong_dan_anh_dai_dien'];

    public function danhSachThucUong()
    {
        return $this->hasMany('App\ThucUong');
    }

    public function getDuongDanAnhDaiDienAttribute()
    {
        if ($this->anh_dai_dien) {
            return request()->getSchemeAndHttpHost() . "/storage/loai-thuc-uong/" . $this->anh_dai_dien;
        }
        return null;
    }
}
