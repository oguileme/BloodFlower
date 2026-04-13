<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/users', UserController::class);
Route::resource('/products', ProductController::class);
Route::resource('/categories', CategoriesController::class);

//mantem cart
Route::put('/clearCart' ,[ CartController::class, 'cleanCart']);
Route::put('/addProduct' ,[ CartController::class, 'addProduct']);
Route::put('/removeProduct' ,[ CartController::class, 'removeProduct']);

