<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller

{
    //
    public function login(Request $req)
    {
        try {

            $req->validate(['userName' => 'required|alpha_dash|min:4|exists:users,user_name',
                'password' => 'required|min:6'
            ]);

            $token = Auth::attempt(['user_name' => $req->userName, 'password' => $req->password]);
            if ( $token) {
                $user = Auth::user();
                return ApiResponse::success([
                    'user' => $user,
                    'access_token' => $token
                ], 200);
            }
            else{
                return ApiResponse::error(401,'Please Check Your Password And Try Again' );
            }
        } catch (\Throwable$e) {

            return ApiResponse::error(401, $e->getMessage());

        }

    }

    public function logout()
    {
        try {
            Auth::logout();
            return ApiResponse::success(null, 200);
        } catch (\Throwable $e) {

            return ApiResponse::error(401, $e->getMessage());
        }
    }

    public function register(Request $req)
    {
        try {
            $req->validate([
                'fullName' => 'required|min:3',
                'userName' => 'required|min:4|alpha_dash|unique:users,user_name',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'birthDate' => 'required',
            ]);
            $user = new User();
            $user->user_name = $req->userName;
            $user->full_name = $req->fullName;
            $user->password = Hash::make($req->password);
            $user->email = $req->email;
            $user->birth_date = date($req->birthDate);

            $res = $user->save();
            $token = Auth::attempt(['user_name' => $req->userName, 'password' => $req->password]);
            if (!$token) {
                return ApiResponse::error('unAuthorized', null, 401);
            } else {
                return ApiResponse::success(['user' => $user, 'access_token' => $token], 'success', 200);
            }

        } catch (\Throwable $exception) {
            return ApiResponse::error(426, $exception->getMessage(), null);
        }
    }
}
