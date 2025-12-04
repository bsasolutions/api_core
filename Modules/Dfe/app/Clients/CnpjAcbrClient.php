<?php

declare(strict_types=1);

namespace Modules\Dfe\App\Clients;

use App\Clients\BaseClient;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\App\Contracts\CnpjProviderInterface;

class CnpjAcbrClient extends BaseClient implements CnpjProviderInterface
{
    public function __construct()
    {
        parent::__construct(config('services.acbr.base_url'));
    }

    protected function getClient(): PendingRequest
    {
        return $this->getHttpInstance()
            ->withToken(config('services.acbr.token'));
    }

    public function fetch(string $cnpj): array
    {
        return [
            'base_url' => $this->baseUrl,
            'token' => config('services.acbr.token'),
            'cnpj' => $cnpj
        ];

        return $this->getClient()
            ->get("/cnpj/{$cnpj}")
            ->json();
    }
}
