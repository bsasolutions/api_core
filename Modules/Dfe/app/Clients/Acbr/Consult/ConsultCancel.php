<?php

namespace Modules\Dfe\app\Clients\Acbr\Consult;

use Modules\Dfe\app\Clients\Acbr\NfeClient;
use App\Exceptions\ApiException;

class ConsultCancel
{
    public function execute(NfeClient $client, array $data): array
    {
        throw new ApiException(['auto', ["Class" =>  class_basename(__CLASS__)]]);
    }
}
