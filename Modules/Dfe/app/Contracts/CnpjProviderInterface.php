<?php

namespace Modules\Dfe\App\Contracts;

interface CnpjProviderInterface
{
    public function fetch(string $cnpj): array;
}
