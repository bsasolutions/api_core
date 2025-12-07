<?php

namespace Modules\Dfe\app\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Dfe\app\Services\NfeService;
use Modules\Dfe\app\Enums\NfeActions;
use Illuminate\Validation\Rule;

class NfeController extends ApiController
{
    public function action(Request $request, NfeService $service)
    {
        $environment = $request->header('X-Env');
        $provider    = $request->header('X-Provider');

        $validated = $request->validate([
            //'action' => 'required|string',
            'action' => ['required', 'string', Rule::in(collect(NfeActions::cases())->map(fn($c) => $c->value))],
            'payload' => 'required|array',
            //'payload.type_document' => 'required|string|in:nfe,cce,cancel,event,inutilize'
            'payload.type_document' => ['required', 'string', Rule::in(['nfe', 'cce', 'cancel', 'event', 'inutilize'])]
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
