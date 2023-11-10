<?php

namespace App\Traits;
use Illuminate\Http\Response;

trait HasHttpResponse
{
    protected function success(string $message, array $data = [], int $status = Response::HTTP_OK):\Illuminate\Http\Response
    {
        return response([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function error(string $message, int $status = Response::HTTP_UNPROCESSABLE_ENTITY):\Illuminate\Http\Response
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    protected function successWithoutData(int $status = Response::HTTP_NO_CONTENT):\Illuminate\Http\Response
    {
        return response( null, $status);
    }
}
