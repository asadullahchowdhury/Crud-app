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
}
