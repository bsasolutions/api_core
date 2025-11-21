<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysServer;
use Modules\Sys\app\Http\Requests\SysServerRequest;
use Modules\Sys\app\Http\Resources\SysServerResource;

class SysServerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysServer, new SysServerResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysServerRequest $request)
    {
        return $this->storeApi(new SysServer, $request, new SysServerResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysServer, new SysServerResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysServerRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysServer, $request, new SysServerResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysServer, new SysServerResource(null), $id);
    }
}
