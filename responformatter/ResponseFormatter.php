<?php

namespace App\Helpers;

/**
 * Format response.
 */
class ResponseFormatter
{
    
    public static function responFormatter($request)
    {

        $response['meta']['status'] = $request['status'];
        $response['meta']['code'] = $request['code'];
        $response['meta']['message'] = $request['message'];
        $response['data'] = $request['data'];

        return response()->json($response, $response['meta']['code']); 
    }

    
}