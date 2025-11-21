<?php

namespace Modules\Sys\app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Modules\Sys\app\Models\SysMenu;
use Modules\Sys\app\Http\Requests\SysMenuRequest;
use Modules\Sys\app\Http\Resources\SysMenuResource;

class SysMenuController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->indexApi(new SysMenu, new SysMenuResource(null));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SysMenuRequest $request)
    {
        return $this->storeApi(new SysMenu, $request, new SysMenuResource(null));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->showApi(new SysMenu, new SysMenuResource(null), $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SysMenuRequest $request, string $id): JsonResponse
    {
        return $this->updateApi(new SysMenu, $request, new SysMenuResource(null), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->destroyApi(new SysMenu, new SysMenuResource(null), $id);
    }
}
