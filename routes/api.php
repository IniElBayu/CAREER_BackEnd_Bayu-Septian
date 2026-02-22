<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserLoginController;


Route::post('/login', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('users', UserLoginController::class);


   
   Route::get('/search/name/{nama}', [UserLoginController::class, 'searchName']);
Route::get('/search/nim/{nim}',   [UserLoginController::class, 'searchNim']);
Route::get('/search/ymd/{ymd}',   [UserLoginController::class, 'searchYmd']);

   
    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

});