<?php

namespace App\Exceptions\Renderers;

use App\Exceptions\ApiException;
use App\Traits\ApiResponseTrait;

class ApiExceptionRenderer
{
    use ApiResponseTrait;

    public function render(ApiException $e, $request)
    {
        return $this->errorResponse(
            [$e->translationKey, $e->params],
            $e->status,
            ['exception' => class_basename($e)] ?? [],
            $e->errors ?? []
        );
    }
}
