<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NhanVienSeeder extends Seeder
{
    public function run()
    {
        DB::table('nhan_vien')->insert(
            [
                [
                    'loai_nhan_vien_id' => 1,
                    'ten_dang_nhap' => 'admin',
                    'mat_khau' => Hash::make('Abc@123'),
                    'ho_ten' => 'Đặng Minh Tân',
                    'email' => 'tandangfit@gmail.com',
                    'so_dien_thoai' => '0868383897'
                ],
                [
                    'loai_nhan_vien_id' => 2,
                    'ten_dang_nhap' => 'kho',
                    'mat_khau' => Hash::make('Abc@123'),
                    'ho_ten' => 'Đặng Minh Tân',
                    'email' => 'tandangfit@gmail.com',
                    'so_dien_thoai' => '0868383897'
                ],
                [
                    'loai_nhan_vien_id' => 3,
                    'ten_dang_nhap' => 'thungan',
                    'mat_khau' => Hash::make('Abc@123'),
                    'ho_ten' => 'Nguyễn Ngọc Lễ',
                    'email' => 'lendangfit@gmail.com',
                    'so_dien_thoai' => '0368058446'
                ]
            ]
        );
    }
}
