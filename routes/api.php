<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\UrlController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//registration api
Route::post('register',[AuthenticationController::class,'register']);
Route::post('login',[AuthenticationController::class,'login']);
Route::post('url-without-auth',[UrlController::class,'generateUrlWithoutAuth']);

Route::middleware('auth:api')->group(function () {
    Route::post('url-with-auth',[UrlController::class,'generateUrlWithAuth']);
    Route::get('profile',[AuthenticationController::class,'profile']);
    Route::get('logout',[AuthenticationController::class,'logout']);
    Route::get('get-links',[UrlController::class,'getLink']);
    Route::put('update-links/{id}',[UrlController::class,'updateLink']);
});
