<?php

declare(strict_types=1);

namespace Modules\Dfe\app\Clients\Acbr;

use App\Clients\BaseClient;
use Modules\Dfe\app\Services\Auth\AcbrAuthService;
use Illuminate\Http\Client\PendingRequest;
use Modules\Dfe\app\Contracts\NfeClientInterface;
use Modules\Dfe\app\Enums\NfeActions;
use App\Traits\ExternalApiRequestTrait;
use App\Exceptions\ApiException;

class NfeClient extends BaseClient implements NfeClientInterface
{
    use ExternalApiRequestTrait;

    public function __construct(private string $environment, private AcbrAuthService $auth)
    {
        parent::__construct(config("dfe.acbr.{$this->environment}.base_url"));
    }

    protected function getClient(): PendingRequest
    {
        $token = $this->auth->getToken($this->environment);

        return $this->getHttpInstance()
            ->withToken($token);
    }

    public function handle(string $action, array $payload): array
    {
        $enum = NfeActions::tryFrom($action);

        if (!$enum) {
            throw new ApiException(['dfe.nfe.invalid_action', ['action' => $action]], 400);
        }

        return match ($enum) {
            NfeActions::EMIT      => $this->emit($payload),
            NfeActions::CONSULT   => $this->consult($payload),
            NfeActions::CANCEL    => $this->cancel($payload),
            NfeActions::CCE       => $this->cce($payload),
            NfeActions::INUTILIZE => $this->inutilize($payload),
            NfeActions::GET_XML   => $this->getXml($payload),
            NfeActions::GET_PDF   => $this->getPdf($payload),
        };
    }

    public function emit(array $payload): array
    {
        return app(Emit\EmitNfe::class)->execute($this, $payload);
    }

    public function consult(array $payload): array
    {
        $type = $payload['type_document'] ?? null;

        if (!$type) {
            throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
        }

        return match ($type) {
            'nfe'       => app(Consult\ConsultNfe::class)->execute($this, $payload),
            'cce'       => app(Consult\ConsultCce::class)->execute($this, $payload),
            'cancel'    => app(Consult\ConsultCancel::class)->execute($this, $payload),
            'event'     => app(Consult\ConsultEvent::class)->execute($this, $payload),
            'inutilize' => app(Consult\ConsultInutilize::class)->execute($this, $payload),
            default     => throw new ApiException(['dfe.nfe.invalid_type_document'], 400)
        };
    }

    public function cancel(array $payload): array
    {
        throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
    }

    public function cce(array $payload): array
    {
        throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
    }
    public function inutilize(array $payload): array
    {
        throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
    }

    public function getXml(array $payload): array
    {
        throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
    }
    public function getPdf(array $payload): array
    {
        throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
    }

    public function request(string $method, string $url, array $payload = []): array
    {
        return $this->performRequest(
            fn() => $this->getClient()->{$method}($url, $payload)
        );
    }
}
