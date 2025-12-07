<?php

namespace Modules\Dfe\app\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Dfe\app\Services\NfeService;

class NfeController extends ApiController
{
    public function action(Request $request, NfeService $service)
    {
        $environment = $request->header('X-Env');
        $provider    = $request->header('X-Provider');

        $validated = $request->validate([
            'action' => 'required|string',
            'payload' => 'required|array'
        ]);

        $data = $service->handle(
            action: $validated['action'],
            payload: $validated['payload'],
            provider: $provider,
            environment: $environment
        );

        return $this->successResponse('dfe.nfe.success', 200, [], $data);
    }
}
