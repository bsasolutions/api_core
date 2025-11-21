<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysProfile;
use Modules\Sys\app\Http\Requests\SysProfileRequest;
use Modules\Sys\app\Http\Resources\SysProfileResource;

class SysProfileController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysProfile, new SysProfileResource(null));
        //return $this->successResponse('SysProfileResource - index', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysProfileRequest $request)
    {
        return $this->storeApi(new SysProfile, $request, new SysProfileResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysProfile, new SysProfileResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysProfileRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysProfile, $request, new SysProfileResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysProfile, new SysProfileResource(null), $id);
    }
}
