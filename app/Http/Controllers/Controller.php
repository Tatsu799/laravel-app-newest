<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;

abstract class Controller
{
    /**
     * success response method
     *
     * @param   string                  $message
     * @param   array<string, mixed>|Collection    $data
     * @return  \Illuminate\Http\JsonResponse
     */
    // public function sendResponse(string $message, array|Collection $data)
    public function sendResponse()
    {
        $response = [
            'status' => 'success',
            'message' => 'Successful',
            'body'    => ['true'],
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @param   string  $message
     * @param   array<int|string, mixed> $errorMessages = []
     * @param   int $code = 404
     * @return  \Illuminate\Http\JsonResponse
     */
    public function sendError(
        string $message,
        array $data = [],
        int $code = 404
    ) {
        $response = [
            'success' => 'Error',
            'message' => $message,
            'body' => [
                'data' => ['false'],
            ]
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }
}
