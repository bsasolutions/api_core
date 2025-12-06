<?php

namespace Modules\Dfe\app\Services;

use Modules\Dfe\app\Enums\NfeActions;
use Modules\Dfe\app\Factories\NfeFactory;

class NfeService
{
    public function __construct(private NfeFactory $factory) {}

    public function handle(string $action, array $payload, ?string $provider = null, ?string $environment = null): array
    {
        $client = $this->factory->make($provider, $environment);
        return $client->handle($action, $payload);
    }
}
