<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/users', UserController::class);
Route::resource('/products', ProductController::class);

Route::resource('/clearCart' ,[ CartController::class, 'cleanCart']);
Route::resource('/addProduct' ,[ CartController::class, 'addProduct']);
Route::resource('/removeProduct' ,[ CartController::class, 'removeProduct']);

