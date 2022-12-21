<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthorController::class, 'index']);
Route::resource('items', ItemController::class);

/* /order -> function 'order' "OrderController" untuk menampilkan view "order" */
/* /order -> function 'createOrder' "OrderController" untuk menjalankan fungsi pembuatan pesanan item */
Route::get('/order', [OrderController::class,'order']);
Route::post('/order', [OrderController::class,'createOrder']);
