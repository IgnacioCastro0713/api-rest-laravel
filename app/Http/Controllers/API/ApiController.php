<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    public function responseSuccess($result, $message, $status = 200)
    {
        return response()->json([
            'ok' => true,
            'status' => $status,
            'message' => $message,
            'data'    => $result,
        ], $status);
    }

    public function responseError($message, $errors = [], $status = 404)
    {
            return response()->json([
                'ok' => false,
                'status' => $status,
                'message' => $message,
                'errors' => $errors
            ], $status);
    }
}
