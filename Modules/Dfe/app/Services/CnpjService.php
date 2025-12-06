<?php

namespace Modules\Dfe\app\Services;

use Modules\Dfe\app\Factories\CnpjFactory;

class CnpjService
{
    public function __construct(private CnpjFactory $factory) {}

    public function fetch(string $cnpj, ?string $provider = null, ?string $environment = null): array
    {
        return $this->factory->make($provider, $environment)->fetch($cnpj);
    }
}
