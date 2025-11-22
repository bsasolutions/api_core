<?php

declare(strict_types=1);

namespace Modules\Message\App\Clients;

use App\Clients\BaseClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class EvolutionClient extends BaseClient
{
    protected string $apiKey;

    public function __construct(?string $configKey = null)
    {
        $configKey = $configKey ?? 'custom.evolution';
        parent::__construct(config("$configKey.api_url") ?? '');
        $this->baseUrl = config("$configKey.api_url") ?? '';
        $this->apiKey = config("$configKey.api_key") ?? '';
    }

    public function setConfig(?string $configKey): void
    {
        $configKey = $configKey ?? 'custom.evolution';
        $this->baseUrl = config("$configKey.api_url") ?? '';
        $this->apiKey = config("$configKey.api_key") ?? '';
    }

    protected function getClient(): PendingRequest
    {
        return $this->getHttpInstance()
            ->baseUrl($this->baseUrl)
            ->withHeaders([
                'apikey' => $this->apiKey,
                'Content-Type' => 'application/json',
            ]);
    }

    // Messages
    public function sendMessageTxt(string $instance, array $payload): Response
    {
        return $this->getClient()->post("/message/sendText/$instance", $payload);
    }

    // Instance management
    public function createInstance(array $payload): Response
    {
        return $this->getClient()->post('/instance/create', $payload);
    }

    public function connectInstance(string $instance): Response
    {
        return $this->getClient()->get("/instance/connect/$instance");
    }

    public function restartInstance(string $instance): Response
    {
        return $this->getClient()->put("/instance/restart/$instance");
    }

    public function statusInstance(string $instance): Response
    {
        return $this->getClient()->get("/instance/connectionState/$instance");
    }

    public function logoutInstance(string $instance): Response
    {
        return $this->getClient()->delete("/instance/logout/$instance");
    }

    public function deleteInstance(string $instance): Response
    {
        return $this->getClient()->delete("/instance/delete/$instance");
    }
}
