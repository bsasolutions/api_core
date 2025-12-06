<?php

namespace Modules\Dfe\app\Contracts;

interface CnpjClientInterface
{
    public function fetch(string $cnpj): array;
}
