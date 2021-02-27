<?php

namespace App\Helpers;

use Mail;

class SCMail
{
    public static function send($user, $data)
    {
        Mail::send('mail.index', $data, function($message) use ($user) {
            $message->from('sc.cskh@gmail.com', 'Sài Gòn coffee');
            $message->to($user->email, $user->ho_ten)->subject('Lấy lại mật khẩu Sài Gòn coffee');
        });
        if (count(Mail::failures()) == 0) {
            return true;
        }
        return false;
    }
}