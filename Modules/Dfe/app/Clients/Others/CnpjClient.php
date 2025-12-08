<?php

declare(strict_types=1);

namespace Modules\Dfe\app\Clients\Others;

use App\Clients\BaseClient;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\app\Contracts\CnpjClientInterface;

class CnpjClient extends BaseClient implements CnpjClientInterface
{
    public function __construct()
    {
        parent::__construct(config('dfe.other.homolog.base_url'));
    }

    protected function getClient(): PendingRequest
    {
        //! Example with Headers directly:
        // return $this->getHttpInstance()->withHeaders(['apikey' => $this->apiKey,'Content-Type' => 'application/json',]);
        //! Example using a parameter in BaseClient:
        // return $this->getHttpInstance([''apikey' => $this->apiKey, 'Content-Type' => 'application/json',])->withToken(config('services.other.token'));
        return $this->getHttpInstance()
            ->withToken(config('dfe.other.homolog.token'));
    }

    public function fetch(string $cnpj): array
    {
        //! Return test data
        return [
            'name' => config('dfe.name'),
            'dfe.acbr.prod.base_url' => config('dfe.acbr.prod.base_url'),
            'dfe.acbr.homolog.base_url' => config('dfe.acbr.homolog.base_url'),
            'dfe.other.homolog.base_url' => $this->baseUrl,
            'dfe.other.homolog.token' => config('dfe.other.homolog.token'),
            'cnpj' => $cnpj
        ];

        //! Example using dynamic baseUrl:
        // $this->setBaseUrl($baseUrl);
        return $this->getClient()->get("/cnpj/{$cnpj}");
    }
}
