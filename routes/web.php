<?php

use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/' , [HomeController::class, 'index']);
Route::get('/product_detail/{id}' , [HomeController::class, 'chiTietSP']);


Route::get('/admin/home' , [HomeAdminController::class, 'Home']);

Route::resource('product', ProductController::class);
