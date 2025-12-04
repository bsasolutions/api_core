<?php

namespace Modules\Msg\App\Services;

use Modules\Msg\App\Clients\EvolutionClient;

class EvolutionService
{
    protected EvolutionClient $client;

    public function __construct(EvolutionClient $client)
    {
        $this->client = $client;
    }

    // Handles generic actions
    public function handleAction(string $action, array $params): array
    {
        $configKey = $params['config'] ?? null;
        $this->client->setConfig($configKey);

        $instance = $params['instance'] ?? 'default_instance';
        if (!$instance) {
            throw new \Exception('Instance not informed');
        }

        try {
            switch ($action) {
                case 'create':
                    return $this->client->createInstance([
                        'instanceName' => $instance,
                        'token' => '',
                        'qrcode' => true,
                        'webhook' => $params['webhook'] ?? '',
                        'webhookByEvents' => false,
                        'events' => [
                            'QRCODE_UPDATED',
                            'MESSAGES_SET',
                            'MESSAGES_UPSERT',
                            'MESSAGES_UPDATE',
                            'MESSAGES_DELETE',
                            'SEND_MESSAGE',
                            'CONNECTION_UPDATE',
                        ],
                    ])->json();

                case 'connect':
                    return $this->client->connectInstance($instance)->json();

                case 'restart':
                    return $this->client->restartInstance($instance)->json();

                case 'status':
                    return $this->client->statusInstance($instance)->json();

                case 'logout':
                    return $this->client->logoutInstance($instance)->json();

                case 'delete':
                    return $this->client->deleteInstance($instance)->json();

                case 'send':
                    return $this->sendMessage($params);
            }
        } catch (\Illuminate\Http\Client\RequestException $e) {
            $status = $e->response?->status() ?? null;
            if ($status === 404) {
                //throw new \RuntimeException("Instance $instance not found", 404, $e);
                throw new \RuntimeException(__('messages.instance_not_found', ['instance' => $instance]), 404, $e);
            }
            throw new \RuntimeException($e->getMessage(), $status ?? 500, $e);
        }

        return [];
    }

    // Message sending logic
    public function sendMessage(array $params): array
    {
        $instance = $params['instance'] ?? 'default_instance';
        $phone = $params['phone'] ?? null;
        $message = $params['message'] ?? null;
        $countryCode = $params['countryCode'] ?? config("custom.evolution.country_code");

        if (!$phone || !$message) {
            return ['error' => 'Phone number or message is missing'];
        }

        if (!$this->validatePhoneNumber($phone, $countryCode)) {
            return ['error' => 'Invalid phone number'];
        }

        try {
            $response = $this->client->sendMessageTxt($instance, [
                'number' => $this->addCountryCode($phone, $countryCode),
                'options' => [
                    'delay' => 1200,
                    'presence' => 'composing',
                ],
                'textMessage' => [
                    'text' => $message
                ],
            ]);

            return $response->json();
        } catch (\Illuminate\Http\Client\RequestException $e) {
            $status = $e->response?->status() ?? null;
            if ($status === 404) {
                throw new \RuntimeException("Instance $instance not found", 404, $e);
            }
            throw new \RuntimeException($e->getMessage(), $status ?? 500, $e);
        }
    }

    //Validate phone number by country.
    private function validatePhoneNumber(string $number, string $countryCode): bool
    {
        $number = preg_replace('/\D/', '', $number);
        $countryCode = preg_replace('/\D/', '', $countryCode);
        if (preg_match('/^' . $countryCode . '[0-9]{8,12}$/', $number) !== 1) {
            return false;
        }
        if ($countryCode === '55') {
            return preg_match('/^55[0-9]{10,11}$/', $number) === 1;
        }

        return true;
    }

    // If it doesn't start with the country code, add the code.
    private function addCountryCode(string $number, string $countryCode): string
    {
        $number = preg_replace('/\D/', '', $number);
        $countryCode = preg_replace('/\D/', '', $countryCode);
        $len = strlen($countryCode);

        if ($len === 0 || substr($number, 0, $len) === $countryCode) {
            return $number;
        }

        return $countryCode . $number;
    }

    //! This does not exist in the old controller
    // Generic webhook: triggers event or logging
    public function handleWebhook(array $payload): void
    {
        // Here you can trigger an event, or call business logic for sending first message
        // Example:
        // event(new WebHookWhatsapp($payload, 'whatsapp'));
    }
}
