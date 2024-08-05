<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsMember;
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
Route::get('/shop' , [HomeController::class, 'shop']);


Route::get('/admin/home' , [HomeAdminController::class, 'Home']);

Route::resource('product', ProductController::class);

Route::resource('category', CategoryController::class);

Route::get('login' , [AuthenController::class , 'showFormLogin'])->name('login');
Route::post('login' , [AuthenController::class , 'handleLogin']);

Route::get('register' , [AuthenController::class , 'showFormRegister'])->name('register');
Route::post('register' , [AuthenController::class , 'handleRegister']);

Route::post('logout' , [AuthenController::class , 'logout'])->name('logout');

Route::get('forgot_password' , [AuthenController::class , 'forgotPass'])->name('forgotPass');
Route::post('forgot_password' , [AuthenController::class , 'forgotPass'])->name('forgotPass');


Route::get('member' , [MemberController::class , 'dashboard'])
->name('member.dashboard')
->middleware(['auth' , IsMember::class]);

Route::get('admins' , [AdminController::class , 'dashboard'])
->name('admins.dashboard')
->middleware(['auth',IsAdmin::class]);


// Giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Thanh toán
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::post('/order/store', [CheckoutController::class, 'store'])->name('order.store');



// Xóa đơn hàng
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
