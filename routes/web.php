<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Multiple product add at time
Route::get('/add-product',[ProductController::class,'addProduct'])->name('add-product');
Route::post('/add-product',[ProductController::class,'storeProduct']);
