<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'code' => 401,
                    'message' => 'Token đã hết hạn!'
                ]);
            }
            else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'code' => 401,
                    'message' => 'Token không hợp lệ!'
                ]);
            }
            else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json([
                    'code' => 401,
                    'message' => 'Token đã bị đưa vào danh sách đen!'
                ]);
            }
            else {
                return response()->json([
                    'code' => 401,
                    'message' => 'Token không được cung cấp!'
                ]);
            }
        }
        if ($exception instanceof \Swift_TransportException) {
            return response()->json([
                'code' => 400,
                'message' => 'Có lỗi trong quá trình gửi mail, vui lòng thử lại sau!'
            ]);
        }
        return parent::render($request, $exception);
    }
}
