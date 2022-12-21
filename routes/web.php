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
Route::get('/nested', [CollectionController::class, 'nestedArray']);
Route::get('/movies', [MovieController::class,'index'])->name('movies.index');
Route::get('/movies/create', [MovieController::class,'create'])->name('movies.create');
Route::post('/movies', [MovieController::class,'store'])->name('movies.store');
Route::get('/movies/{movie}', [MovieController::class,'show'])->name('movies.show');
Route::get('/movies/{movie}/edit', [MovieController::class,'edit'])->name('movies.edit');
Route::patch('/movies/{movie}', [MovieController::class,'update'])->name('movies.update');
Route::delete('/movies/{movie}', [MovieController::class,'destroy'])->name('movies.destroy');
