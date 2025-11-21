<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysPackage;
use Modules\Sys\app\Http\Requests\SysPackageRequest;
use Modules\Sys\app\Http\Resources\SysPackageResource;

class SysPackageController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysPackage, new SysPackageResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysPackageRequest $request)
    {
        return $this->storeApi(new SysPackage, $request, new SysPackageResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysPackage, new SysPackageResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysPackageRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysPackage, $request, new SysPackageResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysPackage, new SysPackageResource(null), $id);
    }
}
