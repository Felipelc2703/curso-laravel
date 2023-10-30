<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => 'auth:sanctum'], function(){



    Route::resource('category', CategoryController::class)->except(["create","edit"]);
    Route::resource('post', PostController::class)->except(["create","edit"]);

});


Route::get('post/all',[PostController::class, 'all']);
// Route::get('post/slug/{slug}',[PostController::class,'slug']);
Route::get('post/slug/{post::slug}',[PostController::class,'slug']);


Route::get('category/slug/{slug}',[CategoryController::class,'slug']);
Route::get('category/all', [CategoryController::class, 'all']);
Route::get('category/{category}/post',[CategoryController::class,'getPostCategory']);


//Usuarios

Route::post('user/login',[UserController::class,'login']);
// Route::resource('category', CategoryController::class)->except(["create","edit"]);
// Route::resource('post', PostController::class)->except(["create","edit"]);

// Route::get('post/all',[PostController::class, 'all']);