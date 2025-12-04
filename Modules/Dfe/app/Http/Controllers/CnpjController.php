<?php

namespace Modules\Dfe\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Modules\Dfe\app\Services\CnpjService;

class CnpjController extends ApiController
{
    public function index()
    {
        return $this->successResponse('dfe/cnpj - index', 200);
    }

    public function show(Request $request, string $cnpj, CnpjService $service)
    {
        $environment = $request->header('X-Environment', 'homolog');
        $provider    = $request->header('X-Provider', null);

        return $service->fetch($cnpj, $provider, $environment);
    }
}
