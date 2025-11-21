<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysGroup;
use Modules\Sys\app\Http\Requests\SysGroupRequest;
use Modules\Sys\app\Http\Resources\SysGroupResource;

class SysGroupController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysGroup, new SysGroupResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysGroupRequest $request)
    {
        return $this->storeApi(new SysGroup, $request, new SysGroupResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysGroup, new SysGroupResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysGroupRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysGroup, $request, new SysGroupResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysGroup, new SysGroupResource(null), $id);
    }
}
