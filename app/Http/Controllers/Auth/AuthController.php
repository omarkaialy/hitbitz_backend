<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendOtp;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ImageService;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller

{    public function __construct(protected ImageService $imageService)
{}
    //
    public function validateToken(Request $request)
    {
        try {
            return ApiResponse::success(Auth::user(),200);
        }catch (\Exception $e){
            ApiResponse::error($e->getCode(), $e->getMessage());
        } }

    public function login(LoginRequest $req)
    {
        try {
            $token = Auth::attempt(['user_name' => $req->userName, 'password' => $req->password]);
            if ($token) {
                $user = Auth::user();
                $user->token = $token;
                $user->save();

                return ApiResponse::success(UserResource::make($user)->includeToken(true), 200);
            } else {
                return ApiResponse::error(401, 'Please Check Your Password And Try Again');
            }
        } catch (Throwable$e) {

            return ApiResponse::error(401, $e->getMessage());

        }

    }

    public function loginAdmin(Request $req)
    {
          try {
            $req->validate(['userName' => 'required|alpha_dash|min:4|exists:users,user_name',
                'password' => 'required|min:6'
            ]);

            $token = Auth::attempt(['user_name' => $req->userName, 'password' => $req->password]);
            if ($token) {
                $user = User::query()->where('id',Auth::user()->id)->with(['roles','category'])->get()->first();

                $user->token = $token;
                if ($user->hasRole('super_admin') || $user->hasRole('admin')) {
                    $user->save();
                    return ApiResponse::success(UserResource::make($user)->includeToken(true),
                        200);
                } else {
                    return ApiResponse::error(401, 'Please Check Your Password And Try Again');
                }
            } else {
                return ApiResponse::error(401, 'Please Check Your Password And Try Again');
            }


        } catch (Throwable $throwable) {
            return ApiResponse::error(401, $throwable->getMessage());
        }

    }

    public function logout()
    {
        try {
            Auth::logout();
            return ApiResponse::success(null, 200);
        } catch (Throwable $e) {

            return ApiResponse::error(401, $e->getMessage());
        }
    }

    public function register(RegisterRequest $req)
    {
        try {

            $user = new User();
            $user->user_name = $req->userName;
            $user->full_name = $req->fullName;
            $user->password = Hash::make($req->password);
            $user->email = $req->email;
            $user->birth_date = date($req->birthDate);
            if (isset($req->referalId)) {
                $referal = User::query()->where('user_name', '=', $req->referalId)->get()->first();
                $user->referrer()->associate($referal->id);
            }
            $user->save();

            $token = Auth::attempt(['user_name' => $user->user_name, 'password' => $req->password]);
            if (!$token) {
                return ApiResponse::error(401, 'UnAuthorized');
            } else {
//                event(new SendOtp($req->email));
                $user->token = $token;
                $user->assignRole('user');
                $user->save();
                $user->access_token = $token;

                return ApiResponse::success(UserResource::make($user)->includeToken(true), 200, 'Otp Send Successfully');
            }

        } catch (Throwable $exception) {
            return ApiResponse::error(426, $exception->getMessage(), null);
        }
    }

    public function verifyEmail(Request $request)
    {
        $request->validate(['code' => 'required|min:4|max:4']);

        $user = Auth::user();

        $otp = (new Otp)->validate($user->email, $request->code);
        if ($otp->status == false) {
            return ApiResponse::error(401, $otp->message);

        } else {
            $user->email_verified_at = now();
            $user->save();
            return ApiResponse::success(null, 200, 'Successfully Verified');
        }

    }

    public function forgetPassword(Request $request)
    {
        $validatedData = Validator::make($request->all(),
            ['email' => 'required|exists:users,users.email']);
        if ($validatedData->valid()) {

            SendOtp::dispatch($request->email, true);
            return ApiResponse::success(null, 200, 'Otp Send');
        } else {
            return ApiResponse::error(425, 'User Not Found');
        }


    }

    public function resendOtp(Request $request)
    {
        event(new SendOtp($request->email));
        return ApiResponse::success(null, 200, 'Otp Snet Successfully');
    }

    public function resetPassword(Request $request)
    {
        $validated = Validator::make($request->all(), ['newPassword' => 'required|min:6', 'code' => 'required|min:4|max:4']);
        if ($validated->valid()) {
            $otp = (new Otp)->validate($request->email, $request->code);
            if ($otp->status == true) {
                $user = User::where('email', $request->email)->first();
                $user->password = Hash::make($request->newPassword);
                $user->save();
                return ApiResponse::success(null, 200, 'Password Reseted Successfully');
            } else {

                return ApiResponse::error(425, 'Wrong Code Please Try Again');
            }

        } else {
            return ApiResponse::error(425, 'Please  Validate Your Inputs');
        }
    }

}
