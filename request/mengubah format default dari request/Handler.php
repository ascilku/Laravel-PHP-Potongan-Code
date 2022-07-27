<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Exception;

class Handler extends ExceptionHandler
{
   

    protected function invalidJson($request, ValidationException  $exception)
    {
        // $data = 
            // 'code' => $exception->status,
            // 'message' => $exception->getMessage(),
            // 'errors' => $exception->errors()
            // $exception->errors();
        

        // self::$response['meta']['message'] = false;
        self::$response['data'] = $exception->errors();

        // You can return json response with your custom form
        // return response()->json([
        //     'success' => false,
            
        // ], $exception->status);

        return response()->json(self::$response, self::$response['meta']['code']);
    }

   

    // protected function invalidJson($request, ValidationException  $exception)
    // {
    //     // You can return json response with your custom form
    //     return response()->json([
    //         'success' => false,
    //         'data' => [
    //             'code' => $exception->status,
    //             'message' => $exception->getMessage(),
    //             'errors' => $exception->errors()
    //         ]
    //     ], $exception->status);
    // }
}
