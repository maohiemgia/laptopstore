<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('client.home');
});

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
    Route::post('store', [UserController::class, 'store']);
    Route::get('{id}', [UserController::class, 'edit']);
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

Route::middleware(['auth', 'verified', 'checkRole'])->prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/create', [ProductController::class, 'create']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'edit']);
});

Route::prefix('/cart')->group(function () {
    Route::get('', [ShoppingCartController::class, 'index']);
    // Route::put('{id}', [ShoppingCartController::class, 'update']);
    // Route::delete('{id}/delete', [ShoppingCartController::class, 'destroy']);
    // Route::put('{id}/restore', [ShoppingCartController::class, 'restore']);
});
