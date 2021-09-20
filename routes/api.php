<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::post('forget-password',[AuthController::class,'forgetPassword']);
Route::post('reset-password',[AuthController::class,'reset']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile',[AuthController::class,'profile']);
    Route::post('update-profile',[AuthController::class,'updateProfile']);
    Route::post('change-password',[AuthController::class,'changePassword']);
    Route::post('logout',[AuthController::class,'logout']);

//    Route::apiResource('blog',BlogController::class);
    Route::get('blog',[BlogController::class,'index']);
    Route::post('blog',[BlogController::class,'store']);
    Route::get('blog/{id}',[BlogController::class,'show']);
    Route::post('blog/{id}',[BlogController::class,'update']);
    Route::delete('blog/{id}',[BlogController::class,'destroy']);
});
