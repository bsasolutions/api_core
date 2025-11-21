<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysUser;
use Modules\Sys\app\Http\Requests\SysUserRequest;
use Modules\Sys\app\Http\Resources\SysUserResource;

class SysUserController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysUser, new SysUserResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysUserRequest $request)
    {
        return $this->storeApi(new SysUser, $request, new SysUserResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysUser, new SysUserResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysUserRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysUser, $request, new SysUserResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysUser, new SysUserResource(null), $id);
    }
}
