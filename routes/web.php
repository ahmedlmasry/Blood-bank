<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationRequestController;
use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AutoCheckPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//    Route::get('/', [MainController::class,'home']);


Route::group(['namespace' => 'Front', 'middleware' => 'auth:client-web'], function () {
    Route::post('toggle-favourite', [MainController::class, 'toggleFavourite']);
});
Route::get('/', [MainController::class, 'home']);
Route::get('posts', [MainController::class, 'allPosts']);
Route::get('posts/{id}', [MainController::class, 'posts']);
Route::get('about', [MainController::class, 'about']);
Route::get('contact-us', [MainController::class, 'contact']);
Route::get('donations', [MainController::class, 'donations']);
Route::get('donation-details/{id}', [MainController::class, 'donationDetails']);
Route::get('client-register', [AuthController::class, 'register']);
Route::post('client-post-register', [AuthController::class, 'postRegister']);
Route::get('client-login', [AuthController::class, 'login']);
Route::post('client-post-login', [AuthController::class, 'postLogin']);


Auth::routes();
    Route::get('home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth', AutoCheckPermission::class],'prefix'=>'admin'], function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::resource('governorate', GovernorateController::class);
    Route::resource('city', CityController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('client', ClientController::class);
    Route::resource('post', PostController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');
    Route::post('update-password', [UserController::class, 'updatePassword'])->name('update-password');
    Route::post('search', [ClientController::class, 'search'])->name('search');
    Route::get('active/{id}', [ClientController::class, 'active'])->name('active');
    Route::get('deactive/{id}', [ClientController::class, 'deactive'])->name('deactive');
    Route::resource('donation-request', DonationRequestController::class);
    Route::post('search-donation', [DonationRequestController::class, 'search'])->name('search-donation');
});






