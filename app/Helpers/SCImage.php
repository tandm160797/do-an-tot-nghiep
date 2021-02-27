<?php

namespace App\Helpers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class SCImage
{
    public static function upload($img, $folder, $size) {
        $fileName = encrypt(date('Y-M-D H:i:s')) . '.' . $img->extension();
        $photo = Image::make($img)->resize($size, $size)->orientate()->encode();;
        Storage::put($folder . '/' . $fileName, $photo);
        return $fileName;
    }

    public static function delete($folder, $fileName) {
        $files = Storage::files('public/' . $folder);
        foreach ($files as $file) {
            if ($file === 'public/' . $folder . '/' . $fileName) {
                Storage::disk('public')->delete($folder . '/' . $fileName);
                return true;
            }
        }
        return false;
    }
}