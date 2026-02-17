<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserLoginController;

Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource('users',UserLoginController::class);

    Route::get('/search/name', fn()=>file_get_contents("https://bit.ly/48ejMhW"));
    Route::get('/search/nim', fn()=>file_get_contents("https://bit.ly/48ejMhW"));
    Route::get('/search/ymd', fn()=>file_get_contents("https://bit.ly/48ejMhW"));

});
