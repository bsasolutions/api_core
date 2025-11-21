<?php

namespace Modules\Sys\app\Http\Controllers;

use App\Http\Controllers\ApiController;
//use Tymo\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Crypt;

class TestController extends ApiController
{
    public function index()
    {
        /*$token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token);
        //!user_id;company;sys_servers_id;sys_groups_id;sys_packages_id;sys_profiles_id
        $cfg = explode(';', Crypt::decryptString($payload->get('cfg')));*/
        return $this->successResponse('sys/test - index', 200);
    }

    public function show($id)
    {
        return $this->successResponse('sys/test - show', 200);
    }
}
