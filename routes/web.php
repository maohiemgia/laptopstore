<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOptionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('/product-list', [HomeController::class, 'products']);
Route::get('/product-detail/{id}', [HomeController::class, 'productdetail']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::post('/checkvoucher', [HomeController::class, 'checkvoucher']);
Route::get('/order-result/{id}', [HomeController::class, 'orderresult']);
Route::get('/find-order', [HomeController::class, 'findorder']);
Route::post('/matchorder', [HomeController::class, 'matchorder']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/search', [HomeController::class, 'searchproduct'])->name('product.search');

//dang làm rở
Route::get('/filter', [HomeController::class, 'filter'])->name('product.filter');

Route::post('/order/store', [OrderController::class, 'store']);

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'checkRole'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified', 'checkRole'])->prefix('/users')->group(function () {
    Route::get('', [UserController::class, 'index']);
    Route::get('create', [UserController::class, 'create']);
    Route::post('store', [UserController::class, 'store'])->name('user.createnewuser');
    Route::get('{id}', [UserController::class, 'edit']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}/delete', [UserController::class, 'destroy']);
});

Route::middleware(['auth', 'verified', 'checkRole'])->prefix('/categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('create', [CategoryController::class, 'create']);
    Route::post('store', [CategoryController::class, 'store']);
    Route::get('{id}', [CategoryController::class, 'edit']);
    Route::put('{id}', [CategoryController::class, 'update']);
    Route::delete('{id}/delete', [CategoryController::class, 'destroy']);
    Route::put('{id}/restore', [CategoryController::class, 'restore']);
});

Route::middleware(['auth', 'verified', 'checkRole'])->prefix('/subcategories')->group(function () {
    Route::get('{id}', [SubCategoryController::class, 'edit']);
    Route::put('{id}', [SubCategoryController::class, 'update']);
    Route::delete('{id}/delete', [SubCategoryController::class, 'destroy']);
    Route::put('{id}/restore', [SubCategoryController::class, 'restore']);
});


Route::prefix('/cart')->group(function () {
    Route::get('', [ShoppingCartController::class, 'index']);
    // Route::put('{id}', [ShoppingCartController::class, 'update']);
    // Route::delete('{id}/delete', [ShoppingCartController::class, 'destroy']);
    // Route::put('{id}/restore', [ShoppingCartController::class, 'restore']);
});


Route::middleware(['auth', 'verified', 'checkRole'])->prefix('products')->group(function () {
    Route::get('', [ProductController::class, 'index']);
    Route::get('create', [ProductController::class, 'create']);
    Route::post('store', [ProductController::class, 'store']);
    Route::get('{id}', [ProductController::class, 'edit']);
    Route::put('{id}', [ProductController::class, 'update']);
    Route::delete('{id}', [ProductController::class, 'destroy']);
    Route::put('{id}/restore', [ProductController::class, 'restore']);
});
Route::middleware(['auth', 'verified', 'checkRole'])->prefix('option')->group(function () {
    Route::get('', [ProductOptionController::class, 'index']);
    Route::get('create', [ProductOptionController::class, 'create']);
    Route::post('store', [ProductOptionController::class, 'store'])->name('option.store');
    Route::get('{id}', [ProductOptionController::class, 'edit']);
    Route::put('{id}', [ProductOptionController::class, 'update']);
    Route::delete('{id}', [ProductOptionController::class, 'destroy']);
    Route::put('{id}/restore', [ProductOptionController::class, 'restore']);
});
Route::middleware(['auth', 'verified', 'checkRole'])->prefix('orders')->group(function () {
    Route::get('', [OrderController::class, 'index']);
    Route::get('create', [OrderController::class, 'create']);
    Route::post('store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('{id}', [OrderController::class, 'edit']);
    Route::put('{id}', [OrderController::class, 'update']);
    Route::delete('{id}', [OrderController::class, 'destroy']);
    Route::put('{id}/restore', [OrderController::class, 'restore']);
});

Route::middleware(['auth', 'verified', 'checkRole'])->prefix('vouchers')->group(function () {
    Route::get('', [VoucherController::class, 'index']);
    Route::get('create', [VoucherController::class, 'create']);
    Route::post('store', [VoucherController::class, 'store'])->name('vouchers.store');
    Route::get('{id}', [VoucherController::class, 'edit']);
    Route::put('{id}', [VoucherController::class, 'update']);
    Route::delete('{id}', [VoucherController::class, 'destroy']);
    Route::put('{id}/restore', [VoucherController::class, 'restore']);
});