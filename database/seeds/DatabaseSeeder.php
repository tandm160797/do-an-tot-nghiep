<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(LoaiNhanVienSeeder::class);
        $this->call(LoaiThucUongSeeder::class);
        $this->call(KhachHangSeeder::class);
        $this->call(NhanVienSeeder::class);
        $this->call(LichSuDiemSeeder::class);
        $this->call(NguyenLieuSeeder::class);
        $this->call(ThucUongSeeder::class);
        $this->call(HoaDonNhapSeeder::class);
        $this->call(HoaDonBanSeeder::class);
        $this->call(ChiTietHoaDonNhapSeeder::class);
        $this->call(ChiTietHoaDonBanSeeder::class);
    }
}
