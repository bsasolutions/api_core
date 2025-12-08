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
        $action = $request->input('action');

        $rules = [
            'action' => ['required', 'string', Rule::in(collect(NfeActions::cases())->map(fn($c) => $c->value)->all())],
            'payload' => 'required|array',
        ];

        if ($action === 'consult') {
            $rules['payload.type_document'] = ['required', 'string', Rule::in(['nfe', 'cce', 'cancel', 'event', 'inutilize'])];
        }

        $validated = $request->validate($rules);

        $data = $service->handle(
            action: $validated['action'],
            payload: $validated['payload'],
            provider: $provider,
            environment: $environment
        );

        return $this->successResponse('dfe.nfe.success', 200, [], $data);
    }
}
