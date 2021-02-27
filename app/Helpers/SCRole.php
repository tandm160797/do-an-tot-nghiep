<?php

namespace App\Helpers;

use App\LoaiNhanVien;

class SCRole
{
    public static function getRoleName($user)
    {
        if (isset($user->loai_nhan_vien_id)) {
            $danhSachLoaiNhanVien = LoaiNhanVien::get();
            foreach ($danhSachLoaiNhanVien as $loaiNhanVien) {
                if ($user->loai_nhan_vien_id === $loaiNhanVien->id) {
                    return $loaiNhanVien->ten;
                }
            }
        }
        return 'Khách hàng';
    }

    public static function isRole($user, $roleName)
    {
        return SCRole::getRoleName($user) === $roleName;
    }

    public static function isRoles($user, $rolesName)
    {
        $rolesNameArray = explode('|', $rolesName);
        foreach ($rolesNameArray as $roleName) {
            if (SCRole::getRoleName($user) === $roleName) {
                return true;
            }
        }
        return false;
    }

    public static function unauthorized ()
    {
        return response()->json([
            'code' => 403,
            'message' => 'Bạn không được phép thực hiện chức năng này!'
        ]);
    }
}