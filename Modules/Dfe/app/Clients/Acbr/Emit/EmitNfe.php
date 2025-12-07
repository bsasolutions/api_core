<?php

namespace Modules\Dfe\app\Clients\Acbr\Emit;

use Modules\Dfe\app\Clients\Acbr\NfeClient;
use App\Exceptions\ApiException;

class EmitNfe
{
    public function execute(NfeClient $client, array $data): array
    {
        if (empty($data['id'])) {
            throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
        }

        return $client->request(
            'get',
            '/nfe/emit',
            $data
        );
    }
}
