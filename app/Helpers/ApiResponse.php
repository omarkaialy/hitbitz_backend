<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data, $status, $message = 'Success')
    {
        return response()->json([
            'status' => true,
            'message' => $message, 'data'=> $data,
        ], $status);
    }

    public static function error($status, $message = 'Error', $data = null)
    {

        return  response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
