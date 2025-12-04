<?php

declare(strict_types=1);

namespace Modules\Dfe\app\Clients;

use App\Clients\BaseClient;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\app\Contracts\CnpjProviderInterface;

class CnpjAcbrClient extends BaseClient implements CnpjProviderInterface
{
    public function __construct()
    {
        parent::__construct(config('dfe.acbr.prod.base_url'));
    }

    protected function getClient(): PendingRequest
    {
        return $this->getHttpInstance()
            ->withToken(config('dfe.acbr.prod.token'));
    }

    public function fetch(string $cnpj): array
    {
        return ["buscar em acbr"];
        return $this->getClient()
            ->get("/cnpj/{$cnpj}")
            ->json();
    }
}
