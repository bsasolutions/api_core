<?php

declare(strict_types=1);

namespace Modules\Dfe\app\Clients\Acbr;

use App\Clients\BaseClient;
use Modules\Dfe\app\Services\Auth\AcbrAuthService;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\app\Contracts\CnpjClientInterface;
use App\Traits\ExternalApiRequestTrait;
use App\Exceptions\ApiException;

class CnpjClient extends BaseClient implements CnpjClientInterface
{
    use ExternalApiRequestTrait;

    public function __construct(private string $environment, private AcbrAuthService $auth)
    {
        parent::__construct(config("dfe.acbr.{$this->environment}.base_url"));
    }

    protected function getClient(): PendingRequest
    {
        $token = $this->auth->getToken($this->environment);

        return $this->getHttpInstance()
            ->withToken($token);
    }

    /*public function fetch(string $cnpj): array
    {
        try {
            $response = $this->getClient()->get("/cnpj/{$cnpj}");
        } catch (\Illuminate\Http\Client\RequestException $e) {

            $status = $e->response?->status();

            if ($status === 401) {
                $response = $e->response;
            } else {
                $data = $e->response ? $e->response->json() : null;

                throw new ApiException(
                    ['dfe.cnpj.external_error', ['details' => $data['error']['message'] ?? 'dfe.cnpj.external_empty']],
                    $e->response?->status() ?? 400
                );
            }
        }

        if ($response->status() === 401) {
            $this->auth->clearTokenCache($this->environment);
            $response = $this->getClient()->get("/cnpj/{$cnpj}");
        }

        return $response->json();
    }*/

    public function fetch(string $cnpj): array
    {
        return $this->performRequest(function () use ($cnpj) {
            return $this->getClient()->get("/cnpj/{$cnpj}");
        });
    }
}
