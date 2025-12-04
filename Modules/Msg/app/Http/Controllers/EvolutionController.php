<?php

namespace Modules\Msg\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Modules\Msg\App\Services\EvolutionService;

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
        try {
            $data = $this->service->handleAction($request->action, $request->all());
            return $this->successResponse('Success', 200, [], $data);
        } catch (\RuntimeException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode() ?: 500
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Unexpected error: ' . $e->getMessage(),
                500
            );
        }
    }

    // Endpoint webhook
    public function webhook(Request $request)
    {
        $this->service->handleWebhook($request->all());

        return 'OK';
    }
}
