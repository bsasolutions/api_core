<?php

namespace Modules\Dfe\app\Factories;

use Modules\Dfe\app\Contracts\CnpjProviderInterface;
use Modules\Dfe\app\Clients\CnpjAcbrClient;
use Modules\Dfe\app\Clients\CnpjOtherClient;

class CnpjClientFactory
{
    public function make(string $provider): CnpjProviderInterface
    {
        return match ($provider) {
            'acbr' => app(CnpjAcbrClient::class),
            'other' => app(CnpjOtherClient::class),
            default => app(CnpjAcbrClient::class),
        };
    }
}
