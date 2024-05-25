<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('user')->group(function(){
    Route::get('/',[UserController::class,'get_all']);
    Route::get('/get/{user_id}',[UserController::class,'get_user_from_id']);
    Route::post('/login',[UserController::class,'login']);
    Route::post('/logout',[UserController::class,'logout']);
    Route::post('create',[UserController::class,'create_user']);
});
