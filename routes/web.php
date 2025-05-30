<?php

use App\Http\Controllers\WebLocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Multiple product add at time
Route::get('/add-product',[ProductController::class,'addProduct'])->name('add-product');
Route::post('/add-product',[ProductController::class,'storeProduct']);
// City, districts, thanas

Route::get('/cities', [WebLocationController::class, 'cities'])->name('cities');
Route::get('/get-cities',[WebLocationController::class,'getCities'])->name('get-cities');
Route::get('/get-district/{city_id}',[WebLocationController::class,'getDistricts'])->name('get-district');
Route::get('/get-thana/{district_id}',[WebLocationController::class,'getThanas'])->name('get-thana');

// Student using Ajax
Route::get('/show-student',[StudentController::class,'index'])->name('show-student');
Route::get('/fetch-student',[StudentController::class,'getStudent'])->name('fetch-student');
Route::get('/create-student',[StudentController::class,'create'])->name('create-student');
Route::post('/create-student',[StudentController::class,'store']);
Route::get('/edit-student/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::post('/edit-student/{id}',[StudentController::class,'update']);
Route::get('/delete-student/{id}',[StudentController::class,'destroy'])->name('student.delete');

