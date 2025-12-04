<?php

namespace Modules\Dfe\App\Services;

use Modules\Dfe\App\Factories\CnpjClientFactory;

class CnpjService
{
    public function __construct(private CnpjClientFactory $factory) {}

    public function fetch(string $cnpj, string $provider): array
    {
        return $this->factory->make($provider)->fetch($cnpj);
    }
}
