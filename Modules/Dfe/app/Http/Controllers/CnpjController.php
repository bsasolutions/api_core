<?php

namespace Modules\Dfe\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Modules\Dfe\App\Services\CnpjService;

class CnpjController extends ApiController
{
    public function index()
    {
        return $this->successResponse('dfe/cnpj - index', 200);
    }

    public function show(Request $request, string $cnpj, CnpjService $service)
    {
        //return $service->fetch($cnpj, $request->input('provider'));
        return $this->successResponse('dfe/cnpj - index' . $cnpj . $request->input('provider'), 200);
    }
}
