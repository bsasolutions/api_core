<?php

namespace Modules\Dfe\app\Clients\Acbr\Consult;

use Modules\Dfe\app\Clients\Acbr\NfeClient;
use App\Exceptions\ApiException;

class ConsultNfe
{
    public function execute(NfeClient $client, array $data): array
    {
        if (empty($data['id'])) {
            throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
        }

        return $client->request(
            'get',
            '/nfe/consult',
            $data
        );
    }
}
