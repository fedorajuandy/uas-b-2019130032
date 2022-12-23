<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [AppController::class,'index'])->name('index');

Route::resource('items', ItemController::class);

Route::prefix('/order')->group(function () {
    Route::get('/', [OrderController::class, 'order'])->name('orders.create');
    Route::post('/', [OrderController::class, 'createOrder'])->name('orders.store');
    Route::get('/index', [OrderController::class, 'list'])->name('orders.index');
    Route::get('/{order}', [OrderController::class,'details'])->name('orders.details');
});
