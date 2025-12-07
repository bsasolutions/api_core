<?php

namespace App\Exceptions\Renderers;

use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponseTrait;
use Throwable;

class ValidationExceptionRenderer
{
    use ApiResponseTrait;

    public function render(ValidationException $e, $request)
    {
        $errors = $e->errors();
        $fields_array = array_keys($errors);
        $all_fields = implode(', ', $fields_array);
        $firstField = array_key_first($errors);
        $firstMessage = $errors[$firstField][0] ?? '';

        return $this->errorResponse(
            ['core.' . $firstMessage, ['field' => $firstField, 'all_fields' => $all_fields]],
            $e->status,
            ['exception' => class_basename($e)] ?? [],
            $errors
        );
    }
}
