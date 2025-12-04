<?php

namespace Modules\Dfe\app\Factories;

use Modules\Dfe\app\Contracts\CnpjProviderInterface;
use Modules\Dfe\app\Clients\CnpjAcbrClient;
use Modules\Dfe\app\Clients\CnpjOtherClient;
use Modules\Dfe\app\Services\Auth\AcbrAuthService;

class CnpjClientFactory
{
    public function make(?string $provider = null, string $environment = 'homolog'): CnpjProviderInterface
    {
        return match ($provider) {
            'acbr' => new CnpjAcbrClient($environment, app(AcbrAuthService::class)),
            'other' => new CnpjOtherClient($environment),
            default => new CnpjAcbrClient($environment, app(AcbrAuthService::class)),
        };
    }
}
