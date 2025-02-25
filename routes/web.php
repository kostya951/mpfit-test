<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/products',[ProductController::class, 'all'])->name('products');
Route::post('/products', [ProductController::class, 'add']);
Route::get('/product/{id}', [ProductController::class, 'get']);
Route::post('/product/edit', [ProductController::class, 'edit']);
Route::get('/product/{id}/delete',[ProductController::class,'delete']);
Route::get('/orders',[OrderController::class,'all'])->name('orders');
Route::post('/orders',[OrderController::class,'add']);
Route::get('/order/{id}',[OrderController::class,'get']);
Route::post('/order/edit',[OrderController::class,'edit']);
Route::get('/order/{id}/delete',[OrderController::class,'delete']);

