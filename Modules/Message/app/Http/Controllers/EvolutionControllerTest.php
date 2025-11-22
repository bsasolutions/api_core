<?php

declare(strict_types=1);

namespace Modules\Message\App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Modules\Message\App\Clients\EvolutionClient;

class EvolutionControllerTest extends ApiController
{
    public function __construct(
        protected EvolutionClient $client
    ) {}

    public function send()
    {
        return $this->client->sendMessageTxt('alphi', [
            //'number' => '5511999999999',
            'number' => '5543999632292',
            'options' => [
                'delay' => 1200,
                'presence' => 'composing',
            ],
            'textMessage' => [
                'text' => 'Message test'
            ],
        ])->json();


        return $data;
    }

    public function status()
    {
        //return $this->successResponse('message/test - aqui', 200);
        //return $this->client->statusInstance('instance01')->json();
        return $this->client->statusInstance('alphi')->json();
    }

    public function connect()
    {
        return $this->client->connectInstance('instance01')->json();
    }

    public function restart()
    {
        return $this->client->restartInstance('instance01')->json();
    }

    public function logout()
    {
        return $this->client->logoutInstance('instance01')->json();
    }

    public function delete()
    {
        return $this->client->deleteInstance('instance01')->json();
    }
}
