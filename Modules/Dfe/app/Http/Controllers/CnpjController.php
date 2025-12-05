<?php

namespace Modules\Dfe\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Modules\Dfe\app\Services\CnpjService;

class CnpjController extends ApiController
{
    public function index()
    {
        return $this->successResponse(['auto', ['route' => ':route']], 200);
    }

    public function show(Request $request, string $cnpj, CnpjService $service)
    {
        $environment = $request->header('X-Env');
        $provider    = $request->header('X-Provider');

        $data = $service->fetch($cnpj, $provider, $environment);

        return $this->successResponse('dfe.cnpj.success', 200, [], $data);
    }
}
