<?php

use Illuminate\Database\Seeder;
use App\LoaiNhanVien;

class LoaiNhanVienSeeder extends Seeder
{
    public function run()
    {
        LoaiNhanVien::firstOrCreate([
            'ten' => 'Admin'
        ]);
        LoaiNhanVien::firstOrCreate([
            'ten' => 'Nhân viên kho'
        ]);
        LoaiNhanVien::firstOrCreate([
            'ten' => 'Nhân viên thu ngân'
        ]);
    }
}
