<?php

declare(strict_types=1);

namespace Modules\Dfe\app\Clients\Acbr;

use App\Clients\BaseClient;
use Modules\Dfe\app\Services\Auth\AcbrAuthService;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\app\Contracts\CnpjClientInterface;
use App\Traits\ExternalApiRequestTrait;

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

    public function fetch(string $cnpj): array
    {
        //! Clear token cache: $this->auth->clearTokenCache($this->environment);
        return $this->performRequest(function () use ($cnpj) {
            return $this->getClient()->get("/cnpj/{$cnpj}");
        });
    }
}
