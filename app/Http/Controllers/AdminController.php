<?php

namespace App\Http\Controllers;

use App\Services\Admin\AdminAuthService;
use http\Env\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin.app');
    }


    public function login(Request  $request){
        $rv = AdminAuthService::login($request);
        return response()->json($rv, 200);
    }


}
