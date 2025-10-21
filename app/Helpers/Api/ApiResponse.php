<?php

namespace App\Helpers\Api;

use Illuminate\Http\JsonResponse;
use Morilog\Jalali\CalendarUtils;

class ApiResponse
{
    public static function Success($message,$data=null): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public static function Fail($response_code , $message , $errors=null): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $response_code);
    }

    public static function FailWithData($response_code , $message , $data=null): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $response_code);
    }
}
