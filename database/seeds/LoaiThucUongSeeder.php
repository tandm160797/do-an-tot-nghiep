<?php

use Illuminate\Database\Seeder;
use App\LoaiThucUong;

class LoaiThucUongSeeder extends Seeder
{
    public function run()
    {
        LoaiThucUong::firstOrCreate([
            'ten' => 'Cà phê',
            'anh_dai_dien' => 'cafe.jpeg'
        ]);
        LoaiThucUong::firstOrCreate([
            'ten' => 'Cream',
            'anh_dai_dien' => 'kem.jpeg'
        ]);
        LoaiThucUong::firstOrCreate([
            'ten' => 'Nước ngọt',
            'anh_dai_dien' => 'nuoc-ngot.jpeg'
        ]);
        LoaiThucUong::firstOrCreate([
            'ten' => 'Nước trái cây',
            'anh_dai_dien' => 'nuoc-trai-cay.jpeg'
        ]);
        LoaiThucUong::firstOrCreate([
            'ten' => 'Sinh tố',
            'anh_dai_dien' => 'sinh-to.jpeg'
        ]);
        LoaiThucUong::firstOrCreate([
            'ten' => 'Strongbow',
            'anh_dai_dien' => 'strongbow.jpeg'
        ]);
        LoaiThucUong::firstOrCreate([
            'ten' => 'Sữa chua',
            'anh_dai_dien' => 'sua-chua.jpeg'
        ]);
        LoaiThucUong::firstOrCreate([
            'ten' => 'Trà',
            'anh_dai_dien' => 'tra.jpeg'
        ]);
        LoaiThucUong::firstOrCreate([
            'ten' => 'Trà sữa',
            'anh_dai_dien' => 'tra-sua.jpeg'
        ]);
    }
}
