<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/users/{id?}',[UserApiController::class,'index']);
Route::post('/users',[UserApiController::class,'store']);
Route::post('/users/multiple',[UserApiController::class,'mul_store']);
Route::put('/users/update/{id}',[UserApiController::class,'update']);
Route::delete('/users/delete/{id}',[UserApiController::class,'destroy']);
