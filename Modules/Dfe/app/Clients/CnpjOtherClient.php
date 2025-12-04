<?php

declare(strict_types=1);

namespace Modules\Dfe\App\Clients;

use App\Clients\BaseClient;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\App\Contracts\CnpjProviderInterface;

class CnpjOtherClient extends BaseClient implements CnpjProviderInterface
{

    public function __construct()
    {
        parent::__construct(config('services.other.base_url'));
    }

    protected function getClient(): PendingRequest
    {
        //! Example with Headers directly: return $this->getHttpInstance()->withHeaders(['apikey' => $this->apiKey,'Content-Type' => 'application/json',]);
        //! Example using a parameter in BaseClient: return $this->getHttpInstance([''apikey' => $this->apiKey, 'Content-Type' => 'application/json',])->withToken(config('services.other.token'));
        return $this->getHttpInstance()
            ->withToken(config('services.other.token'));
    }

    public function fetch(string $cnpj): array
    {
        return [
            'base_url' => $this->baseUrl,
            'token' => config('services.acbr.token'),
            'cnpj' => $cnpj
        ];

        //! Example using dynamic baseUrl: $this->setBaseUrl($baseUrl);
        return $this->getClient()
            ->get("/cnpj/{$cnpj}")
            ->json();
    }
}
