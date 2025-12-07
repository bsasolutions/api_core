<?php

namespace Modules\Dfe\app\Http\Controllers;

use App\Http\Controllers\ApiController;
//use Tymo\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Crypt;
use App\Exceptions\ApiException;
use RuntimeException;

class TestController extends ApiController
{
    public function index()
    {
        /*$token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token);
        //!user_id;company;sys_servers_id;sys_groups_id;sys_packages_id;sys_profiles_id
        $cfg = explode(';', Crypt::decryptString($payload->get('cfg')));*/
        return $this->successResponse(['auto', ['route' => ':route']]);
    }

    public function show($id)
    {
        //! Use ApiResponseTrait (successResponse and errorResponse) to format and translate
        //! throw already uses ApiResponseTrait(errorResponse) to format and ApiResponseTrait attempts to translate
        // ApiResponseTrait:
        // The parameter :route always includes uri + method in ApiResponseTrait
        // 1: Auto translation → Try to translate automatically using rotation
        // 2: With parameter → Send key and parameters to lang
        // 3: Without parameter → Send key by string
        // 4: Without parameter → Send key by array
        // 5: Throw exception → Sends key, static text, or auto. Does not accept parameters
        // 6: Throw ApiException → Custom throw to accept parameters
        // 7: Static text → It does not format with ApiResponseTrait
        // 0: Simple response → It does not format with ApiResponseTrait
        if ($id == 1)
            return $this->successResponse(['auto', ['id' => $id, 'type' => 'auto_translation']]);
        else if ($id == 2)
            return $this->successResponse(['dfe.test.show', ['route' => 'dfe/test → show', 'id' => $id, 'type' => 'with_parameter']]);
        else if ($id == 3)
            return $this->successResponse('dfe.test.show');
        else if ($id == 4)
            return $this->successResponse(['dfe.test.show']);
        else if ($id == 5)
            throw new RuntimeException('auto');
        else if ($id == 6)
            throw new ApiException(['dfe.test.show', ['route' => 'dfe/test → show', 'id' => $id, 'type' => 'Throw_ApiException']]);
        else if ($id == 7)
            return $this->successResponse('Module Dfe Route Test Method Show');
        else
            return response()->json([__('dfe/test.show')]);
    }
}
