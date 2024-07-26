<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('governorates', [MainController::class,'governorates']);
Route::get('cities', [MainController::class,'cities']);
Route::get('bloodTypes', [MainController::class,'bloodTypes']);
Route::get('contacts', [MainController::class,'contacts']);
Route::get('settings', [MainController::class,'settings']);
Route::get('categories ', [MainController::class,'categories']);
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('reset-password', [AuthController::class,'resetPassword']);
Route::post('new-password', [AuthController::class,'newPassword']);

Route::group(['middleware'=>'auth:api'],function(){
    Route::post('profile', [AuthController::class,'profile']);
    Route::post('notifications-settings', [AuthController::class,'notificationsSettings']);
    Route::get('posts', [MainController::class,'posts']);
    Route::post('post-favourite', [MainController::class,'postFavourite']);
    Route::get('my-favourite', [MainController::class,'myFavourite']);
    Route::post('donation-request', [MainController::class,'donationRequest']);
    Route::post('register-token', [AuthController::class,'registerToken']);
});

