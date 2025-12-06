<?php

namespace Modules\Dfe\app\Factories;

use Modules\Dfe\app\Contracts\CnpjClientInterface;
use Modules\Dfe\app\Clients\Acbr\CnpjClient as AcbrCnpjClient;
use Modules\Dfe\app\Clients\Others\CnpjClient as OtherCnpjClient;
use Modules\Dfe\app\Services\Auth\AcbrAuthService;
use App\Exceptions\ApiException;

class CnpjFactory
{
    protected array $requiredKeysMap = [
        'acbr'  => ['base_url', 'client_id', 'client_secret'],
        'other' => ['base_url', 'token'],
    ];

    public function make(?string $provider = null, ?string $environment = null): CnpjClientInterface
    {

        $provider = $provider ?: 'acbr';
        $environment = $environment ?: 'homolog';
        $config = config("dfe.$provider.$environment");

        if (!$config || !is_array($config)) {
            throw new ApiException(
                ['dfe.cnpj.provider_config_not_found', ['provider' => $provider, 'environment' => $environment]],
                400
            );
        }

        $requiredKeys = $this->requiredKeysMap[$provider] ?? [];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $config) || $config[$key] === null || $config[$key] === '') {
                throw new ApiException(
                    ['dfe.cnpj.provider_config_missing_key', ['provider' => $provider, 'environment' => $environment, 'key' => $key]],
                    400
                );
            }
        }

        return match ($provider) {
            'acbr' => new AcbrCnpjClient($environment, app(AcbrAuthService::class)),
            'other' => new OtherCnpjClient($environment),
        };
    }
}
