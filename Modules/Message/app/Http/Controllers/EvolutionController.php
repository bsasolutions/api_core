<?php

namespace Modules\Message\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Modules\Message\App\Services\EvolutionService;

class EvolutionController extends ApiController
{
    protected EvolutionService $service;

    public function __construct(EvolutionService $service)
    {
        $this->service = $service;
    }

    // Endpoints: create, connect, restart, status, logout, delete, send
    public function action(Request $request)
    {
        //$action = $request->action;
        //$data = $this->service->handleAction($action, $request->all());
        $data = $this->service->handleAction($request->action, $request->all());

        return response()->json($data, 200);
    }

    // Endpoint webhook
    public function webhook(Request $request)
    {
        $this->service->handleWebhook($request->all());

        return 'OK';
    }
}
