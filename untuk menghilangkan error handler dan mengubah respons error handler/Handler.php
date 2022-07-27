<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Exception;

class Handler extends ExceptionHandler
{
   

  
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {  
            return $this->handleApiException($request, $exception);
        } else {
            $retval = parent::render($request, $exception);
        }

        return $retval;
    }

    private function handleApiException($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['status'] = 'Unauthorized';
                $response['message'] = 'Terjadi Unauthorized Akses';
                break;
            case 403:
                $response['status'] = 'Forbidden';
                $response['message'] = 'Terjadi Forbidden Akses';
                break;
            case 404:
                $response['status'] = 'Not Found';
                $response['message'] = 'Terjadi Not Found Akses';
                break;
            case 500:
                $response['status'] = 'Method Not Allowed';
                $response['message'] = 'Terjadi Method Not Allowed Akses';
                break;
            case 422:
                $response['status'] = $exception->original['message'];
                $response['message'] = $exception->original['errors'];
                break;
            // default:
            //     $response['status'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
            //     break;
        }

        if (config('app.debug')) {
            $data['trace'] = $exception->getTrace();
            $data['code'] = $exception->getCode();
        }

        // $response['status'] = $statusCode;

        $data['meta']['code'] = $statusCode;
        $data['meta']['status'] = $response['status'];
        $data['meta']['message'] = $response['message'] ;
        $data['data'] = null;

        return response()->json($data, $statusCode);
    }

  
}
