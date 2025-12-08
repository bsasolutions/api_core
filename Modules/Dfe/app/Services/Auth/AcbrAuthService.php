<?php

declare(strict_types=1);

namespace Modules\Dfe\app\Services\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Throwable;

class AcbrAuthService
{
    public function getToken(string $environment = 'homolog'): string
    {
        $config = config("dfe.acbr.$environment");

        if (!$config) {
            throw new RuntimeException("Configuration for environment [$environment] not found.");
        }

        $cacheKey = "acbr_api_token_{$environment}";

        if (Cache::has($cacheKey)) {
            $token = Cache::get($cacheKey);
            //! Debug token: $parts = explode('.', $token); $payload = json_decode(base64_decode($parts[1]), true); throw new RuntimeException("TOKEN CACHE ACBr ($environment): "  . ($payload['iat'] ?? 'sem iat') . ' - ' . ($payload['exp'] ?? 'sem exp') . ' - ' . $token);
            return $token;
        }

        try {
            $response = Http::asForm()
                ->post('https://auth.acbr.api.br/oauth/token', [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => $config['client_id'],
                    'client_secret' => $config['client_secret'],
                    'scope'         => $config['scope'],
                ])
                ->throw()
                ->json();
        } catch (Throwable $e) {
            throw new RuntimeException(
                "Failed to obtain ACBr token ($environment): " . $e->getMessage(),
                0,
                $e
            );
        }

        if (empty($response['access_token'])) {
            throw new RuntimeException("Invalid response from auth server: access_token missing.");
        }

        $expiresIn = $response['expires_in'] ?? 3600;
        $ttlSeconds = max(60, $expiresIn - 60);

        Cache::put($cacheKey, $response['access_token'], $ttlSeconds);

        return $response['access_token'];
    }

    public function clearTokenCache(string $environment = 'homolog'): void
    {
        Cache::forget("acbr_api_token_{$environment}");
    }
}
