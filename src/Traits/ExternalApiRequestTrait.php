<?php

namespace Bsa\Core\Traits;

use Bsa\Core\Exceptions\ApiException;

trait ExternalApiRequestTrait
{
    public function performRequest(callable $callback): array
    {
        try {
            $response = $callback();
        } catch (\Illuminate\Http\Client\RequestException $e) {

            $status = $e->response?->status();

            if ($status === 401) {
                $this->auth->clearTokenCache($this->environment);
                $response = $callback(); // retry
            } else {
                $body = $e->response?->json();

                throw new ApiException(
                    ['external.error', [
                        'details' => $body['error']['message'] ?? 'external.empty'
                    ]],
                    $status ?? 400
                );
            }
        }

        return $response->json();
    }
}
