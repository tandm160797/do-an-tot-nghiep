<?php

use Illuminate\Database\Seeder;

class ThucUongSeeder extends Seeder
{
    public function run()
    {
        DB::table('thuc_uong')->insert(
            [
                // Loại 1.
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Americano',
                    'hinh_anh' => 'americano.jpeg',
                    'gia' => 32000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Breve',
                    'hinh_anh' => 'breve.jpeg',
                    'gia' => 27000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Cafe đen',
                    'hinh_anh' => 'cafe_den.jpeg',
                    'gia' => 32000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Cafe sữa',
                    'hinh_anh' => 'cafe_sua.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Capuccino',
                    'hinh_anh' => 'capuccino.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Double Espresso',
                    'hinh_anh' => 'double_espresso.jpeg',
                    'gia' => 50000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Espresso',
                    'hinh_anh' => 'espresso.jpeg',
                    'gia' => 40000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Ice Espresso Milk Double',
                    'hinh_anh' => 'ice_espresso_milk_double.jpeg',
                    'gia' => 59000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Ice Espresso Milk',
                    'hinh_anh' => 'ice_espresso_milk.jpeg',
                    'gia' => 55000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Irish',
                    'hinh_anh' => 'irish.jpeg',
                    'gia' => 45000
                ],
                
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Latte Macchiato',
                    'hinh_anh' => 'latte_macchiato.jpeg',
                    'gia' => 45000
                ],
                [
                    'loai_thuc_uong_id' => 1,
                    'ten' => 'Mocha',
                    'hinh_anh' => 'mocha.jpeg',
                    'gia' => 35000
                ],

                // Loại 2.
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Bingsu',
                    'hinh_anh' => 'bingsu.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem chuối',
                    'hinh_anh' => 'kem_chuoi.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem sữa dâu',
                    'hinh_anh' => 'kem_drink_dau.jpeg',
                    'gia' => 22000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem sữa Việt Quốc',
                    'hinh_anh' => 'kem_drink_viet_quoc.jpeg',
                    'gia' => 29000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem tươi Socola',
                    'hinh_anh' => 'kem_tuoi_chocolate.jpeg',
                    'gia' => 26000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem tươi vị bạc hà',
                    'hinh_anh' => 'kem_tuoi_vi_bac_ha.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem tươi dừa',
                    'hinh_anh' => 'kem_tuoi_vi_dua.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem tươi vị khoai môn',
                    'hinh_anh' => 'kem_tuoi_vi_khoai_mon.jpeg',
                    'gia' => 32000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem tươi vị thanh long',
                    'hinh_anh' => 'kem_tuoi_vi_thanh_long.jpeg',
                    'gia' => 30000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem tươi vị Vani',
                    'hinh_anh' => 'kem_tuoi_vi_vani.jpeg',
                    'gia' => 30000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem tươi Socola',
                    'hinh_anh' => 'kem_tuoi_chocolate.jpeg',
                    'gia' => 24000
                ],
                [
                    'loai_thuc_uong_id' => 2,
                    'ten' => 'Kem tươi vị xoài',
                    'hinh_anh' => 'kem_tuoi_vi_xoai.jpeg',
                    'gia' => 25000
                ],
                // Loại 3.
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Bò húc',
                    'hinh_anh' => 'bo_huc.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Coca',
                    'hinh_anh' => 'coca.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Dr.Thanh',
                    'hinh_anh' => 'dr_thanh.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Fanta hương cam',
                    'hinh_anh' => 'fanta_huong_cam.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Fanta hương chanh',
                    'hinh_anh' => 'fanta_huong_chanh.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Fanta hương trái cây',
                    'hinh_anh' => 'fanta_huong_trai_cay.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Fanta hương Việt Quốc',
                    'hinh_anh' => 'fanta_huong_viet_quoc.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Mirinda vị cam',
                    'hinh_anh' => 'mirinda_vi_cam.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Mirinda vị soda',
                    'hinh_anh' => 'mirinda_vi_soda.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Number one',
                    'hinh_anh' => 'number_one.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Pepsi',
                    'hinh_anh' => 'pepsi.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Revice chanh muối',
                    'hinh_anh' => 'revive_chanh_muoi.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Revice',
                    'hinh_anh' => 'revive.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Seven up',
                    'hinh_anh' => 'seven_up.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Sting đỏ',
                    'hinh_anh' => 'sting_do.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'String vàng',
                    'hinh_anh' => 'sting_vang.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'Tê giác húc',
                    'hinh_anh' => 'te_giac_huc.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 3,
                    'ten' => 'WARRIOR',
                    'hinh_anh' => 'warrior.jpeg',
                    'gia' => 15000
                ],
                // Loại 4.
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Chanh dây',
                    'hinh_anh' => 'chanh_day.jpeg',
                    'gia' => 20000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước chanh',
                    'hinh_anh' => 'nuoc_chanh.jpeg',
                    'gia' => 20000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước dừa',
                    'hinh_anh' => 'nuoc_dua.jpeg',
                    'gia' => 20000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép cà chua',
                    'hinh_anh' => 'nuoc_ep_ca_chua.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép cà rốt',
                    'hinh_anh' => 'nuoc_ep_ca_rot.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép cam',
                    'hinh_anh' => 'nuoc_ep_cam.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép cần tây',
                    'hinh_anh' => 'nuoc_ep_can_tay.jpeg',
                    'gia' => 20000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép củ dền',
                    'hinh_anh' => 'nuoc_ep_cu_den.jpeg',
                    'gia' => 20000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép dưa dấu',
                    'hinh_anh' => 'nuoc_ep_dua_hau.jpeg',
                    'gia' => 20000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép táo',
                    'hinh_anh' => 'nuoc_ep_tao.jpeg',
                    'gia' => 30000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép thơm',
                    'hinh_anh' => 'nuoc_ep_thom.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Nước ép Việt Quốc',
                    'hinh_anh' => 'nuoc_ep_viet_quoc.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 4,
                    'ten' => 'Sữa bắp',
                    'hinh_anh' => 'sua_bap.jpeg',
                    'gia' => 30000
                ],
                
                // Loại 5...
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố bơ',
                    'hinh_anh' => 'sinh_to_bo.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố cam',
                    'hinh_anh' => 'sinh_to_cam.jpeg',
                    'gia' => 30000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố chuối',
                    'hinh_anh' => 'sinh_to_chuoi.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố đu đủ',
                    'hinh_anh' => 'sinh_to_du_du.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố dưa gang',
                    'hinh_anh' => 'sinh_to_dua_gang.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố dừa',
                    'hinh_anh' => 'sinh_to_dua.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố mãng cầu',
                    'hinh_anh' => 'sinh_to_mang_cau.jpeg',
                    'gia' => 30000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố mít',
                    'hinh_anh' => 'sinh_to_mit.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố Sapoche',
                    'hinh_anh' => 'sinh_to_sapoche.jpeg',
                    'gia' => 2000
                ],
                [
                    'loai_thuc_uong_id' => 5,
                    'ten' => 'Sinh tố xoài',
                    'hinh_anh' => 'sinh_to_xoai.jpeg',
                    'gia' => 25000
                ],
                // Loại 6
                [
                    'loai_thuc_uong_id' => 6,
                    'ten' => 'Apple Ciders British Dry',
                    'hinh_anh' => 'strongbow_apple_ciders_british_dry.jpeg',
                    'gia' => 20000
                ],
                [
                    'loai_thuc_uong_id' => 6,
                    'ten' => 'Apple Ciders',
                    'hinh_anh' => 'strongbow_apple_ciders.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 6,
                    'ten' => 'Apple Rose',
                    'hinh_anh' => 'strongbow_apple_rose.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 6,
                    'ten' => 'Elderflower',
                    'hinh_anh' => 'strongbow_elderflower.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 6,
                    'ten' => 'Gold Apple',
                    'hinh_anh' => 'strongbow_gold_apple.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 6,
                    'ten' => 'Honey',
                    'hinh_anh' => 'strongbow_honey.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 6,
                    'ten' => 'Red Berries',
                    'hinh_anh' => 'strongbow_red_berries.jpeg',
                    'gia' => 35000
                ],
                // Loại 7
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua bạc hà',
                    'hinh_anh' => 'sua_chua_bac_ha.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua Cafe',
                    'hinh_anh' => 'sua_chua_cafe.jpeg',
                    'gia' => 65000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua chanh dây',
                    'hinh_anh' => 'sua_chua_chanh_day.jpeg',
                    'gia' => 45000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua Socola',
                    'hinh_anh' => 'sua_chua_chocolate.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua đậu đỏ',
                    'hinh_anh' => 'sua_chua_dau_do.jpeg',
                    'gia' => 30000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua đậu nành',
                    'hinh_anh' => 'sua_chua_dau_nanh.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua dâu',
                    'hinh_anh' => 'sua_chua_dau.jpeg',
                    'gia' => 55000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua dưa hấu',
                    'hinh_anh' => 'sua_chua_dua_hau.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua mít',
                    'hinh_anh' => 'sua_chua_mit.jpeg',
                    'gia' => 45000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua nha đam',
                    'hinh_anh' => 'sua_chua_nha_dam.jpeg',
                    'gia' => 45000
                ],
                [
                    'loai_thuc_uong_id' => 7,
                    'ten' => 'Sữa chua phúc bồn tử',
                    'hinh_anh' => 'sua_chua_phuc_bon_tu.jpeg',
                    'gia' => 35000
                ],
                // Loại 8
                [
                    'loai_thuc_uong_id' => 8,
                    'ten' => 'Trà Atiso',
                    'hinh_anh' => 'tra_atiso.jpeg',
                    'gia' => 25000
                ],
                [
                    'loai_thuc_uong_id' => 8,
                    'ten' => 'Trà chanh',
                    'hinh_anh' => 'tra_chanh.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 8,
                    'ten' => 'Trà đá',
                    'hinh_anh' => 'tra_da.jpeg',
                    'gia' => 15000
                ],
                [
                    'loai_thuc_uong_id' => 8,
                    'ten' => 'Trà đào',
                    'hinh_anh' => 'tra_dao.jpeg',
                    'gia' => 45000
                ],
                [
                    'loai_thuc_uong_id' => 8,
                    'ten' => 'Trà lipton',
                    'hinh_anh' => 'tra_lipton.jpeg',
                    'gia' => 55000
                ],
                [
                    'loai_thuc_uong_id' => 8,
                    'ten' => 'Trà ô lông',
                    'hinh_anh' => 'tra_o_long.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 8,
                    'ten' => 'Trà xanh nguyên chất',
                    'hinh_anh' => 'tra_xanh_nguyen_chat.jpeg',
                    'gia' => 65000
                ],
                // Loại 9
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa bạc hà',
                    'hinh_anh' => 'tra_sua_bac_ha.jpeg',
                    'gia' => 45000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa cafe',
                    'hinh_anh' => 'tra_sua_cafe.jpeg',
                    'gia' => 65000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa đậu đỏ',
                    'hinh_anh' => 'tra_sua_dau_do.jpeg',
                    'gia' => 35000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa dâu tây',
                    'hinh_anh' => 'tra_sua_dau_tay.jpeg',
                    'gia' => 55000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa flant',
                    'hinh_anh' => 'tra_sua_flant.jpeg',
                    'gia' => 45000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa matcha',
                    'hinh_anh' => 'tra_sua_matcha.jpeg',
                    'gia' => 45000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa socola',
                    'hinh_anh' => 'tra_sua_socola.jpeg',
                    'gia' => 55000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa sương sáo',
                    'hinh_anh' => 'tra_sua_suong_sao.jpeg',
                    'gia' => 40000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa trân châu',
                    'hinh_anh' => 'tra_sua_tran_chau.jpeg',
                    'gia' => 55000
                ],
                [
                    'loai_thuc_uong_id' => 9,
                    'ten' => 'Trà sữa việt quốc',
                    'hinh_anh' => 'tra_sua_viet_quoc.jpeg',
                    'gia' => 35000
                ]
            ]
        );
    }
}