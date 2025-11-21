<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysModule;
use Modules\Sys\app\Http\Requests\SysModuleRequest;
use Modules\Sys\app\Http\Resources\SysModuleResource;

class SysModuleController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysModule, new SysModuleResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysModuleRequest $request)
    {
        return $this->storeApi(new SysModule, $request, new SysModuleResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysModule, new SysModuleResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysModuleRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysModule, $request, new SysModuleResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysModule, new SysModuleResource(null), $id);
    }
}
