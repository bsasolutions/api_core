<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysMessage;
use Modules\Sys\app\Http\Requests\SysMessageRequest;
use Modules\Sys\app\Http\Resources\SysMessageResource;

class SysMessageController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysMessage, new SysMessageResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysMessageRequest $request)
    {
        return $this->storeApi(new SysMessage, $request, new SysMessageResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysMessage, new SysMessageResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysMessageRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysMessage, $request, new SysMessageResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysMessage, new SysMessageResource(null), $id);
    }
}
