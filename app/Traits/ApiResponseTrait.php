<?php

namespace App\Traits;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\MessageBag;

trait ApiResponseTrait
{
    public function successResponse(string $message, int $status = 200, array $meta = [], array|Arrayable|JsonResource $data = [])
    {
        $response = [
            'message' => $message,
            'meta' => $meta,
            'data' => $data instanceof Arrayable ? $data->toArray() : $data,
        ];
        return response()->json($response, $status);
    }
    public function errorResponse(string $message, int $status = 400, array $meta = [], array|Arrayable|JsonResource $errors = [])
    {
        $response = [
            'message' => $message,
            'meta' => $meta,
            'errors' => $errors instanceof Arrayable ? $errors->toArray() : $errors,
        ];
        return response()->json($response, $status);
    }
}
