<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponseTrait;

class ApiRequest extends FormRequest
{
    use ApiResponseTrait;
    protected function failedValidation(Validator $validator)
    {
        $http = $this->errorResponse('Invalid', 422, [], $validator->errors());
        throw new HttpResponseException(
            $http
        );
    }
}
