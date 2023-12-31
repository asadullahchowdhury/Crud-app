<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Admin\AdminAuthService;


class AdminAuthController extends Controller
{
    public function login(Request  $request){
        $rv = AdminAuthService::login($request);
        return response()->json($rv, 200);
    }
    public function register(Request  $request){
        $rv = AdminAuthService::register($request);
        return response()->json($rv, 200);
    }

    public function profile_details(Request $request)
    {

        $rv = AdminAuthService::profile_details($request);
        return response()->json($rv, 200);
    }    public function profile_logout(Request $request)
    {
        $rv = AdminAuthService::profile_logout($request);
        return response()->json($rv, 200);
    }
}
