<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KhachHangSeeder extends Seeder
{
    public function run()
    {
        DB::table('khach_hang')->insert(
            [
                [
                    'ten_dang_nhap' => 'tan',
                    'mat_khau' => Hash::make('Abc@123'),
                    'ho_ten' => 'Đặng Minh Tân',
                    'email' => 'tandangfit@gmail.com',
                    'so_dien_thoai' => '0868383897',
                    'dia_chi' => '7/66 đường 385, quận 9, TP.HCM'
                ],
                [
                    'ten_dang_nhap' => 'le',
                    'mat_khau' => Hash::make('Abc@123'),
                    'ho_ten' => 'Nguyễn Ngọc Lễ',
                    'email' => 'ledangfit@gmail.com',
                    'so_dien_thoai' => '0368058446',
                    'dia_chi' => '7/66 đường 385, quận 9, TP.HCM'
                ],
            ]
        );
    }
}
