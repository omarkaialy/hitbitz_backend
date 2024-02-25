<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', [AuthController::class, 'loginAdmin']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/roadmaps/store', [\App\Http\Controllers\RoadmapController::class, 'store']);
    Route::post('/categories/store', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::post('/subcategories/store', [\App\Http\Controllers\SubcategoryController::class, 'store']);

});
Route::group(['prefix' => 'user'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify',[AuthController::class,'verifyEmail']);
    Route::post('/resend',[AuthController::class,'resendOtp']);
    Route::post('/forgetPassword',[AuthController::class,'forgetPassword']);
    Route::post('/resetPassword',[AuthController::class,'resetPassword']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('/roadmaps', [\App\Http\Controllers\RoadmapController::class, 'index']);

});
Route::get('/migrate', function () {
    Artisan::call('migrate:fresh --seed');
    return (ApiResponse::success(null, 200));
});
