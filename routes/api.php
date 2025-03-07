<?php

use App\Helpers\ApiResponse;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LevelDetailController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\UserController;
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
    Route::get('/cvs', [\App\Http\Controllers\CvController::class, 'index']);
    Route::post('/cvs', [\App\Http\Controllers\CvController::class, 'store']);
    Route::post('/cvs/{cv}/accept', [\App\Http\Controllers\CvController::class, 'accept']);
    Route::post('/cvs/{cv}/reject', [\App\Http\Controllers\CvController::class, 'reject']);

    Route::post('/validate', [AuthController::class, 'validateToken'])->middleware('auth');
    Route::post('/verify', [AuthController::class, 'verifyEmail']);
    Route::post('/resend', [AuthController::class, 'resendOtp']);
    Route::post('/forgetPassword', [AuthController::class, 'forgetPassword']);
    Route::post('/resetPassword', [AuthController::class, 'resetPassword']);

    Route::post('/send-notification', [\App\Http\Controllers\NotificationController::class, 'store']);
    Route::post('/login', [AuthController::class, 'loginAdmin']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/roadmaps/store', [RoadmapController::class, 'store']);
    Route::delete('/roadmaps/{roadmap}', [RoadmapController::class, 'destroy']);
    Route::get('/roadmaps/{roadmap}', [RoadmapController::class, 'show']);
    Route::post('/categories/store', [CategoryController::class, 'store']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/levels/store', [LevelController::class, 'store']);
    Route::delete('/levels/{level}', [LevelController::class, 'destroy']);
    Route::get('/levels/{id}', [LevelController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/roadmaps', [RoadmapController::class, 'index']);
    Route::get('/levels', [LevelController::class, 'index']);
    Route::get('/levelStep', [LevelDetailController::class, 'index']);
    Route::post('/levelStep/store', [LevelDetailController::class, 'store']);
    Route::delete('/levelStep/{levelDetail}', [LevelDetailController::class, 'destroy']);
    Route::get('/levelStep/{id}', [LevelDetailController::class, 'show']);
    Route::get('/subcategories', [CategoryController::class, 'indexSubs']);
    Route::get('/roadmaps', [RoadmapController::class, 'index']);
    Route::get('/levels', [LevelController::class, 'index']);
    Route::get('/levelStep', [LevelDetailController::class, 'index']);
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::post('/questions/store', [QuestionController::class, 'store']);
    Route::post('/quizzes/store', [QuizController::class, 'store']);
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy']);
    Route::get('/quizzes/{id}', [QuizController::class, 'show']);
    Route::get('/suggestions', [\App\Http\Controllers\SuggestionController::class, 'index']);
    Route::post('/createAdmin', [UserController::class, 'createAdmin']);
    Route::post('/updateAdmin/{user}', [UserController::class, 'update']);
    Route::post('/blockAdmin/{user}', [UserController::class, 'blockAdmin']);
    Route::get('/admins', [UserController::class, 'indexAdmins']);
    Route::get('/admins/{user}', [UserController::class, 'showAdmin']);

});
Route::group(['prefix' => 'user'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/validate', [AuthController::class, 'validateToken'])->middleware('auth');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify', [AuthController::class, 'verifyEmail']);
    Route::post('/resend', [AuthController::class, 'resendOtp']);
    Route::post('/forgetPassword', [AuthController::class, 'forgetPassword']);
    Route::post('/resetPassword', [AuthController::class, 'resetPassword']);
    Route::post('/updateProfile', [UserController::class, 'updateProfile'])->middleware('auth');

});

Route::group(['prefix' => 'user'], function () {
    Route::post('/challenge',[ChallengeController::class,'store'])->middleware('auth');
    Route::get('/challenges',[ChallengeController::class,'index'])->middleware('auth');
    Route::get('/certificate', [QuizController::class, 'certificate']);

    Route::get('/quizzes/createCustomQuiz', [QuizController::class, 'createCustomQuiz'])->middleware('auth');
    Route::post('/quizzes/completeCustomQuiz', [QuizController::class, 'completeCustomQuiz'])->middleware('auth');
    Route::get('/myRoadmaps', [UserController::class, 'getMyRoadmaps'])->middleware('auth');
    Route::get('/getHomeRoadmap', [UserController::class, 'getHomeRoadmap'])->middleware('auth');

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::get('/friendRequests', [\App\Http\Controllers\FriendshipController::class, 'indexRequests']);
    Route::post('/friendRequests', [\App\Http\Controllers\FriendshipController::class, 'sendFriendRequest']);
    Route::post('/acceptRequest', [\App\Http\Controllers\FriendshipController::class, 'acceptRequest']);
    Route::post('/cancelFriendship', [\App\Http\Controllers\FriendshipController::class, 'cancelFriendship']);
    Route::get('/friends', [\App\Http\Controllers\FriendshipController::class, 'indexFriends']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/subcategories', [CategoryController::class, 'indexSubs']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::get('/roadmaps', [RoadmapController::class, 'index']);
    Route::get('/roadmaps/{roadmap}', [RoadmapController::class, 'show'])->middleware('auth');
    Route::get('/roadmaps/favorites/index', [RoadmapController::class, 'indexFavorites'])->middleware('auth');
    Route::get('/roadmaps/{roadmap}/toggleFavorite', [UserController::class, 'toggleFavorite'])->middleware('auth');
    Route::get('/roadmaps/{roadmap}/start', [UserController::class, 'startRoadmap'])->middleware('auth');
    Route::post('/roadmaps/{roadmap}/rate', [UserController::class, 'rateRoadmap'])->middleware('auth');
    Route::get('/levels', [LevelController::class, 'index']);
    Route::get('/levelStep', [LevelDetailController::class, 'index']);
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/quizzes/{id}', [QuizController::class, 'show']);
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::post('/quizzes/{quiz}/complete', [QuizController::class, 'complete'])->middleware('auth');
    Route::post('/makeSuggestion', [\App\Http\Controllers\SuggestionController::class, 'store']);
    Route::get('/myReferrals', [UserController::class, 'indexReferees'])->middleware('auth');
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index']);
});
Route::get('/migrate', function () {
    Artisan::call('queue:work --stop-when-empty');
    return (ApiResponse::success(null, 200));
});
Route::get('/migrate-test', function () {
    return ApiResponse::success(null, 200);
});
