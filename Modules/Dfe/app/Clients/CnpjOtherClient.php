<?php

declare(strict_types=1);

namespace Modules\Dfe\App\Clients;

use App\Clients\BaseClient;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\App\Contracts\CnpjProviderInterface;

//use Illuminate\Http\Client\Response;

class CnpjOtherClient extends BaseClient implements CnpjProviderInterface
{

    public function __construct()
    {
        parent::__construct(config('services.other.base_url'));
    }

    protected function getClient(): PendingRequest
    {
        return $this->getHttpInstance()
            ->withToken(config('services.other.token'));
    }


    /*protected function getClient(): PendingRequest
    {
        return $this->getHttpInstance()
            ->baseUrl($this->baseUrl)
            ->withHeaders([
                'apikey' => $this->apiKey,
                'Content-Type' => 'application/json',
            ]);
    }*/


    public function fetch(string $cnpj): array
    {
        return $this->getClient()
            ->get("/cnpj/{$cnpj}")
            ->json();
    }

    /*public function consultar(string $cnpj): array
    {
        $url = "https://prod.other.api.br/cnpj/{$cnpj}";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.other.token'),
        ])->get($url);

        return $response->json();
    }*/
}
