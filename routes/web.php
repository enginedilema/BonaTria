<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/importMercadona', [CategoryController::class,'getCategoryFromMercadona']);
Route::get('/importProductFromMercadona', [ProductController::class,'getProductFromMercadona']);