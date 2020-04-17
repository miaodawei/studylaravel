<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            $code = $exception->getCode() ? $exception->getCode() : '400';
            // 只读取错误中的第一个错误信息
            $errors = $exception->errors();
            // 框架返回的是二维数组，因此需要去循环读取第一个数据
            if($errors){
                foreach ($errors as $key => $val) {
                    $keys = array_key_first($val);
                    $message = $val[$keys];
                    break;
                }
            }
        }elseif ($exception instanceof AuthenticationException) {
            $code = '400';
            $message = $exception ->getMessage();
        }else{
            $code = $exception->getCode() ? $exception->getCode() : '400';
            $message = $exception ->getMessage();
        }
        return response()->json(['code' => $code, 'message' => $message, 'data' => []]);
//        return parent::render($request, $exception);
    }
}
