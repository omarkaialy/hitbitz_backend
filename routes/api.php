<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LevelDetailController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\SubcategoryController;
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
Route::group([], function () {
    Route::post('uploadImage', [ImageController::class, 'store']);
    Route::post('upload64Image', [ImageController::class, 'uploadImage64']);
});
Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', [AuthController::class, 'loginAdmin']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/roadmaps/store', [RoadmapController::class, 'store']);
    Route::delete('/roadmaps/{roadmap}', [RoadmapController::class, 'destroy']);
    Route::post('/categories/store', [CategoryController::class, 'store']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    Route::post('/subcategories/store', [SubcategoryController::class, 'store']);
    Route::delete('/subcategories/{subcategory}', [SubcategoryController::class, 'destroy']);
    Route::post('/levels/store', [LevelController::class, 'store']);
    Route::delete('/levels/{level}', [LevelController::class, 'destroy']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/roadmaps', [RoadmapController::class, 'index']);
    Route::get('/levels', [LevelController::class, 'index']);
    Route::get('/levelStep', [LevelDetailController::class, 'index']);
    Route::post('/levelStep/store', [LevelDetailController::class, 'store']);
    Route::delete('/levelStep/{levelDetail}', [LevelDetailController::class, 'destroy']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/subcategories', [CategoryController::class, 'indexSubs']);
    Route::get('/roadmaps', [RoadmapController::class, 'index']);
    Route::get('/levels', [LevelController::class, 'index']);
    Route::get('/levelStep', [LevelDetailController::class, 'index']);
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::post('/quizzes/store', [QuizController::class, 'store']);
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy']);

});
Route::group(['prefix' => 'user'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify', [AuthController::class, 'verifyEmail']);
    Route::post('/resend', [AuthController::class, 'resendOtp']);
    Route::post('/forgetPassword', [AuthController::class, 'forgetPassword']);
    Route::post('/resetPassword', [AuthController::class, 'resetPassword']);

});

Route::group(['prefix' => 'user'], function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/roadmaps', [RoadmapController::class, 'index']);
    Route::get('/levels', [LevelController::class, 'index']);
    Route::get('/levelStep', [LevelDetailController::class, 'index']);

});
Route::get('/migrate', function () {
    Artisan::call('migrate:fresh --seed');
    return (ApiResponse::success(null, 200));
});
