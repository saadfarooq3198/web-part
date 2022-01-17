<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/',function(){
    return view('users');
});
Route::get('pass', [UserController::class,'pass']);
Route::get('get_users', [UserController::class,'get_users']);
// Route::post('update_user/{id}', [UserController::class,'update_user']);
Route::resource('users',UserController::class);
Route::resource('products',ProductController::class);

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');
require __DIR__.'/auth.php';
