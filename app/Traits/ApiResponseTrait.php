<?php

namespace App\Traits;

use Illuminate\Contracts\Support\Arrayable;

trait ApiResponseTrait
{
    /*
    Field	    Description	        Example
    message	    mensagem simples	Consulta realizada com sucesso.
    status	    código HTTP	        200, 201, 400, 404
    meta	    detalhes extras	    provider, ambiente, paginação
    data	    dados principais    dados do CNPJ
    errors	    erros detalhados    causas, validações, respostas do provider
    */
    public function successResponse(string|array $message, int $status = 200, array $meta = [], mixed $data = [])
    {
        $response = [
            'success' => true,
            'message' => $this->formatMessage($message),
            'meta' => $meta,
            'data' => $data instanceof Arrayable ? $data->toArray() : $data,
        ];
        return response()->json($response, $status, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function errorResponse(string|array $message, int $status = 400, array $meta = [], mixed $errors = [])
    {
        $response = [
            'success' => false,
            'message' => $this->formatMessage($message),
            'meta' => $meta,
            'errors' => $errors instanceof Arrayable ? $errors->toArray() : $errors,
        ];
        return response()->json($response, $status, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function formatMessage(string|array $message): string
    {
        // Array: [ 'lang.key', ['placeholders_key' => 'placeholders_value'] ]
        // Example:
        // controller: successResponse(['lang.success_cnpj', ['cnpj' => 123]]);
        // lang: 'success_cnpj' => 'CNPJ :cnpj cadastrado com sucesso',
        // translation: CNPJ 123 cadastrado com sucesso
        if (is_array($message)) {
            [$key, $placeholders] = $message + [null, []];

            if (is_string($key)) {
                return __($key, $placeholders);
            }

            return (string) json_encode($message, JSON_UNESCAPED_UNICODE);
        }

        // String type lang.key → Example: successResponse('lang.success_cnpj');
        if ((str_contains($message, '.')) && (!str_contains($message, ' ')) && (preg_match('/^[a-z0-9._-]+$/', $message))) {
            return __($message);
        }

        // String and not lang.key → Example: successResponse('Cadastrado com sucesso');
        return $message;
    }
}
