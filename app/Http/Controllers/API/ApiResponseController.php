<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class ApiResponseController extends Controller
{

    public function responseSuccess($result, $message)
    {
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => $message,
            'data'    => $result,
        ], 200);
    }

    public function responseError($error, $errorMessages = [], $code = 404)
    {
            return response()->json([
                'status' => false,
                'code' => $code,
                'message' => $error,
                'errors' => $errorMessages
            ], $code);
    }
}
