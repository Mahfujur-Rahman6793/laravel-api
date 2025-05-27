<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\LocationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/users/{id?}',[UserApiController::class,'index']);
Route::post('/users',[UserApiController::class,'store']);
Route::post('/users/multiple',[UserApiController::class,'mul_store']);
Route::put('/users/update/{id}',[UserApiController::class,'update']);
Route::delete('/users/delete/{id}',[UserApiController::class,'destroy']);


// City, District and Thana
Route::get('/city-details', [LocationController::class, 'cities'])->name('city_details');
Route::get('/cities', [LocationController::class, 'getCities'])->name('cities');
Route::get('/districts/{city_id}', [LocationController::class, 'getDistricts'])->name('districts');
Route::get('/thanas/{district_id}', [LocationController::class, 'getThanas'])->name('thanas');


// City, District and Thana for postman
Route::post('/store/cities', [LocationController::class, 'storeCities'])->name('store_cities');
Route::post('/store/districts', [LocationController::class, 'storeDistricts'])->name('store_districts');
Route::post('/store/thanas', [LocationController::class, 'storeThanas'])->name('store_thanas');
