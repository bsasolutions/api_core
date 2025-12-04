<?php

declare(strict_types=1);

namespace Modules\Dfe\app\Clients;

use App\Clients\BaseClient;
use Modules\Dfe\app\Services\Auth\AcbrAuthService;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\app\Contracts\CnpjProviderInterface;

class CnpjAcbrClient extends BaseClient implements CnpjProviderInterface
{
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

    public function fetch(string $cnpj): array
    {
        $response = $this->getClient()->get("/cnpj/{$cnpj}");

        if ($response->status() === 401) {
            $this->auth->clearTokenCache($this->environment);
            $response = $this->getClient()->get("/cnpj/{$cnpj}");
        }

        return $response->json();
    }
}
