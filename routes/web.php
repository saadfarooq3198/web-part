<?php

use App\Http\Controllers\CategoryController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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
Route::get('get_users', [UserController::class,'get_users']);
Route::get('/search', [UserController::class,'search']);
Route::resource('users',UserController::class);
Route::resource('products',ProductController::class);
Route::post('pagination/fetch', [ProductController::class,'fetch'])->name('pagination.fetch');
Route::post('pagination/fetch_user', [UserController::class,'fetch_user'])->name('pagination.fetch_user');
// Route::get('/count',function(){
//     $count = Product::where('category_id',3)->count('category_id');
//     echo $count;
// });
// category Routes
Route::resource('categories',CategoryController::class);
Route::post('pagination/fetch_category', [CategoryController::class,'fetch_category'])->name('pagination.fetch_category');



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');
require __DIR__.'/auth.php';
