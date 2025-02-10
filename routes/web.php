<?php

use App\Models\Finance;
use App\Models\ImgHome;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ImgHomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Middleware\AdminMiddleware;

// Route::get('/', function () {return view('rest.index');})->name('login')->middleware('guest');

Route::get('/', [ImgHomeController::class, 'Home'])->name('login')->middleware('guest');
Route::get('/contact', function () {return view('rest.contact');});
Route::get('/checkout', function () {return view('rest.checkout');});
Route::get('/success', function () {return view('rest.success');});
// Route::get('/orders', function () {return view('rest.orders');});

Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
    Route::post('/tambah', [MenuController::class, 'store'])->name('store');
    Route::get('/', [MenuController::class, 'index'])->name('crudmenu');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::post('/tambah', [CategoryController::class, 'store'])->name('store');
    Route::get('/', [CategoryController::class, 'index'])->name('crudcategory');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'table', 'as' => 'table.'], function () {
    Route::get('/tables', [TableController::class, 'index'])->name('index');
    Route::post('/tambah', [TableController::class, 'store'])->name('store');
});

Route::group(['prefix' => 'imghome', 'as' => 'imghome.'], function () {
    Route::get('/', [ImgHomeController::class, 'create'])->name('crudimghome');
    Route::post('/tambah', [ImgHomeController::class, 'store'])->name('store');
    Route::get('/', [ImgHomeController::class, 'index'])->name('crudimghome');
    Route::put('imghome/{id}', [ImgHomeController::class, 'update'])->name('update');
    Route::delete('imghome/{id}', [ImgHomeController::class, 'destroy'])->name('destroy');
});

// Route::get('/',[ImgHomeController::class,'ImgHomeUser'])->name('imguser.imguser');

// Route::group(['prefix' => 'finance', 'as' => 'finance.'], function () {
//     Route::get('/', [FinanceController::class, 'create'])->name('finance');
// });

Route::group(['prefix' => 'rest', 'as' => 'rest.'], function () {
    // Route::get('/', [MenuController::class, 'viewmenu'])->name('vmenu');
    Route::get('/', [MenuController::class, 'indexuser'])->name('vmenu');
});

Route::group(['prefix' => 'detail', 'as' => 'detail.'], function () {
    Route::get('/', [MenuController::class, 'viewdetail'])->name('detail');
});

Route::get('/notif/check', [CartController::class, 'checkNotification'])->name('notif.check');

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('/', [CartController::class, 'viewcart'])->name('cart');
    // Route::get('/{id}', [CartController::class, 'showCart'])->name('show');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
    Route::get('/', [CheckoutController::class, 'view'])->name('checkout');
    Route::get('/{id}', [CheckoutController::class, 'showCart'])->name('show');
    Route::post('/order',[CheckoutController::class,'store'])->name('placeOrder');
});

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/', [OrderController::class, 'ViewOrder'])->name('index');
    Route::delete('order/{id}', [OrderController::class, 'destroy'])->name('destroy');
});

// Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
//     Route::get('/', [LoginController::class, 'view'])->name('view');
//     Route::post('/', [LoginController::class, 'login'])->name('loginin');
// });


// Route Login
 Route::get('/login',[LoginController::class,'index'])->name('admin.login')->middleware(AdminMiddleware::class);
 Route::get('/register',[LoginController::class,'register'])->name('admin.register')->middleware(AdminMiddleware::class); 
 Route::post('/process-register',[LoginController::class,'processRegister'])->name('admin.processRegister'); 
 Route::post('/authenticate',[LoginController::class,'authenticate'])->name('admin.authenticate');
 

//  Route Logout
Route::post('/logout',[LogoutController::class,'logout'])->name('logout.logout');

// admin
// Route untuk halaman pembuatan atau CRUD pesanan
Route::get('/crud-order', [OrderController::class, 'create'])->name('order.crudorder')->middleware('auth');
Route::get('/menu', [MenuController::class, 'create'])->name('menu.crudmenu')->middleware('auth');
Route::get('/category', [CategoryController::class, 'create'])->name('category.crudcategory')->middleware('auth');
Route::get('/table', [TableController::class, 'create'])->name('table.crudtable')->middleware('auth');

// Route untuk update data berdasarkan ID
Route::put('table/update/{id}', [TableController::class, 'update'])->name('table.update');

// Route untuk delete data berdasarkan ID
Route::delete('table/delete/{id}', [TableController::class, 'destroy'])->name('table.destroy');


// Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('update-cart');

Route::get('/scan/{id}', [TableController::class, 'scan'])->name('scan');