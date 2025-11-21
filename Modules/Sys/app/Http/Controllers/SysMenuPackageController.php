<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysMenuPackage;
use Modules\Sys\app\Http\Requests\SysMenuPackageRequest;
use Modules\Sys\app\Http\Resources\SysMenuPackageResource;

class SysMenuPackageController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysMenuPackage, new SysMenuPackageResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysMenuPackageRequest $request)
    {
        return $this->storeApi(new SysMenuPackage, $request, new SysMenuPackageResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysMenuPackage, new SysMenuPackageResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysMenuPackageRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysMenuPackage, $request, new SysMenuPackageResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysMenuPackage, new SysMenuPackageResource(null), $id);
    }
}
