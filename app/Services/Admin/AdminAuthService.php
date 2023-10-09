<?php

namespace App\Services\Admin;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class AdminAuthService
{
    public static function login($request)
    {

        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|exists:admins,email',
                    'password' => 'required|min:6'
                ]
            );

            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }

            $user = User::where('email', $request->email)->first();
            if($user->email_verified_at == null){
                return ['status' => 500, 'errors' => ['error' => 'Account not verified']];
            }
            $credential = ['email' => $request->email, 'password' => $request->password];
            if (Auth::guard('admins')->attempt($credential, $request->remember)) {
                return ['status' => 200, 'data' => Auth::guard('admins')->user()];
            } else {
                return ['status' => 500, 'errors' => ['error' => 'Invalid Credentials! Please try again']];
            }
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }
}
