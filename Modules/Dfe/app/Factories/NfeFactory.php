<?php

namespace Modules\Dfe\app\Factories;

use Modules\Dfe\app\Clients\Acbr\NfeClient as AcbrNfeClient;
use Modules\Dfe\app\Contracts\NfeClientInterface;
use Modules\Dfe\app\Services\Auth\AcbrAuthService;
use App\Exceptions\ApiException;

class NfeFactory
{
    protected array $requiredKeysMap = [
        'acbr'  => ['base_url', 'client_id', 'client_secret'],
    ];

    public function make(?string $provider, ?string $environment): NfeClientInterface
    {
        $provider = $provider ?: 'acbr';
        $environment = $environment ?: 'homolog';
        $config = config("dfe.$provider.$environment");

        if (!$config || !is_array($config)) {
            throw new ApiException(
                ['dfe.nfe.provider_config_not_found', ['provider' => $provider, 'environment' => $environment]],
                400
            );
        }

        $requiredKeys = $this->requiredKeysMap[$provider] ?? [];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $config) || $config[$key] === null || $config[$key] === '') {
                throw new ApiException(
                    ['dfe.nfe.provider_config_missing_key', ['provider' => $provider, 'environment' => $environment, 'key' => $key]],
                    400
                );
            }
        }

        return match ($provider) {
            'acbr' => new AcbrNfeClient($environment, app(AcbrAuthService::class)),
            default => throw new ApiException(['dfe.nfe.provider_not_supported'], 400)
        };
    }
}
