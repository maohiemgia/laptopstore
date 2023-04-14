<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ProductOptionController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/users', UserController::class);
Route::apiResource('/products', ProductController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/subcategories', SubCategoryController::class);

Route::get('/product-detail/{id}', [HomeController::class, 'productdetail']);
Route::post('/updatecart', [ShoppingCartController::class, 'store']);

Route::apiResource('/option', ProductOptionController::class);
Route::apiResource('/orders', OrderController::class);
Route::apiResource('/detail', OrderDetailController::class);
Route::apiResource('/vouchers', VoucherController::class);
