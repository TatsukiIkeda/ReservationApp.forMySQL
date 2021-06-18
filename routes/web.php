<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use Illuminate\Database\Eloquent\SoftDeletes;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('order', [OrderController::class, 'index']);
Route::post('order/selectdate', [OrderController::class, 'selectdate']);
Route::get('order/create', [OrderController::class, 'create']);
Route::post('order/create', [OrderController::class, 'store']);
Route::get('order/edit/{id}', [OrderController::class, 'edit']);
Route::post('order/edit/', [OrderController::class, 'update']);
Route::get('order/del/{id}', [OrderController::class, 'del']);
Route::get('order/instock/{id}', [OrderController::class, 'instock']);
Route::get('/order/notinstock/{id}', [OrderController::class, 'notinstock']);

Route::get('/logout', [OrderController::class, 'logout']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




