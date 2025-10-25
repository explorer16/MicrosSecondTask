<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

trait Responsable
{
    public function sendResponse($data = [], $message = ''): JsonResponse
    {
        return response()->json(data: [
            'data' => $data,
            'message' => $message,
            'timestamp' => Carbon::now()->toDateTimeString(),
            'success' => true,
        ]);
    }

    public function sendError($data = [], $message = ''): JsonResponse
    {
        return response()->json(data: [
            'data' => $data,
            'message' => $message,
            'timestamp' => Carbon::now()->toDateTimeString(),
            'success' => false,
        ]);
    }
}
