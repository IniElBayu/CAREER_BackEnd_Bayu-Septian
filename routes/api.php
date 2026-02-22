<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserLoginController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTE (WAJIB LOGIN SANCTUM)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    /*
    |-----------------------------------------
    | CRUD USER LOGIN
    |-----------------------------------------
    */
    Route::apiResource('users', UserLoginController::class);


    /*
    |-----------------------------------------
    | SEARCH DATA REALTIME
    |-----------------------------------------
    | C -> nama = Turner Mia
    | D -> nim  = 9352078461
    | E -> ymd  = 20230405
    */
   Route::get('/search/name/{nama}', [UserLoginController::class, 'searchName']);
Route::get('/search/nim/{nim}',   [UserLoginController::class, 'searchNim']);
Route::get('/search/ymd/{ymd}',   [UserLoginController::class, 'searchYmd']);

    /*
    |-----------------------------------------
    | OPTIONAL: cek user login aktif
    |-----------------------------------------
    */
    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

});