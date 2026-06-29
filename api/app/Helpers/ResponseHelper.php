<?php

namespace App\Helpers;

class ResponseHelper 
{
    public static function SuccessResponse(mixed $data, string $message)
    {
        $result = [
            'code' => 200,
            'data' => $data,
            'message' => $message,
            'error' => null,
        ];
        return response()->json($result);
    }
}