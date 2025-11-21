<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysMenuProfile;
use Modules\Sys\app\Http\Requests\SysMenuProfileRequest;
use Modules\Sys\app\Http\Resources\SysMenuProfileResource;

class SysMenuProfileController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysMenuProfile, new SysMenuProfileResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysMenuProfileRequest $request)
    {
        return $this->storeApi(new SysMenuProfile, $request, new SysMenuProfileResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysMenuProfile, new SysMenuProfileResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysMenuProfileRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysMenuProfile, $request, new SysMenuProfileResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysMenuProfile, new SysMenuProfileResource(null), $id);
    }
}
