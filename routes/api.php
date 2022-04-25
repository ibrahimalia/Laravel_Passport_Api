<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>'auth:api'],function(){

    Route::get('/user',[AuthController::class,'infoUser']);
    Route::get('/logout',[AuthController::class,'logout']);
});
Route::group(['middleware'=>'auth:api-admin'],function(){

    Route::get('/admin',[AuthController::class,'infoAdmin']);
    Route::get('/logout',[AuthController::class,'logout']);
});
Route::post('/user/register',[AuthController::class,'register']);
Route::post('/user/login',[AuthController::class,'login']);
Route::post('/admin/register',[AuthController::class,'registerAdmin']);
Route::post('/admin/login',[AuthController::class,'loginAdmin']);
