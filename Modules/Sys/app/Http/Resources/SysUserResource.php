<?php

namespace Modules\Sys\app\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;

class SysUserResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data = $this->toArrayApi($data);
        return $data;
    }
}
