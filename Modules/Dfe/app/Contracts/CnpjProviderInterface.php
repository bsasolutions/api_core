<?php

namespace Modules\Dfe\app\Contracts;

interface CnpjProviderInterface
{
    public function fetch(string $cnpj): array;
}
