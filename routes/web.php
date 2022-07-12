<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OneClickOrderController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserAccountController;


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

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::post('/subscribe', [SubscribeController::class, 'subscribe']);
Route::get('/tag/get', [MainController::class, 'getMorePopularProducts']);

Route::get('/category/{category:slug}', [MainController::class, 'categoryPage']);
Route::get('/category/{category:slug}/p', [MainController::class, 'paginationCategoryPage']);
Route::get('/products/{product:slug}', [MainController::class, 'getProductById']);
Route::get('/categories/get', [CategoryController::class, 'get']);

Route::get('/tag/{tag:slug}', [MainController::class, 'tagPage']);
Route::get('/tag/{tag:slug}/p', [MainController::class, 'paginationTagPage']);
Route::get('/tags/get', [TagController::class, 'get']);

Route::get('/info/{info}', [MainController::class, 'infoPage']);

Route::get('/ordering', [MainController::class, 'orderingPage']);
Route::post('/orders', [OrderController::class, 'store']);
Route::post('/one-click-orders', [OneClickOrderController::class, 'store']);

Route::get('/search', [MainController::class, 'searchPage']);
Route::get('/search/s', [MainController::class, 'search']);

Route::get('/account/{id}', [UserAccountController::class, 'account'])->name('account');

//Route::get('/admin', function () {
//  return view('admin.pages.home');
//});
Route::group(['prefix' => 'admin', 'middleware' => ['roles:manager,admin']], function () {
  Route::get('/', function () {
    return view('admin.pages.home');
  });
});

Route::group(['prefix' => 'admin', 'middleware' => ['roles:admin']], function () {
  Route::get('/users', [UserController::class, 'index']);
  Route::get('/users/p', [UserController::class, 'paginationUsers']);
  Route::get('/users/search', [UserController::class, 'searchUsers']);
  Route::get('/users/{user}/edit', [UserController::class, 'edit']);
  Route::put('/users/{user}', [UserController::class, 'update']);
  Route::delete('/users/{user}', [UserController::class, 'destroy']);
});


Route::group(['prefix' => 'admin', 'middleware' => ['roles:manager']], function () {

  Route::get('/categories', [CategoryController::class, 'index']);
  Route::post('/categories', [CategoryController::class, 'store']);
  Route::get('/categories/refresh', [CategoryController::class, 'refresh']);
  Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
  Route::put('/categories/{category}', [CategoryController::class, 'update']);
  Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

  Route::get('/products', [ProductController::class, 'index']);
  Route::get('/products/search', [ProductController::class, 'searchProducts']);
  Route::post('/products', [ProductController::class, 'store']);
  Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
  Route::put('/products/{product}', [ProductController::class, 'update']);
  Route::delete('/products/{product}', [ProductController::class, 'destroy']);
  Route::get('/products/p', [ProductController::class, 'paginationProduct']);

  Route::get('/tags', [TagController::class, 'index']);
  Route::post('/tags', [TagController::class, 'store']);
  Route::get('/tags/refresh', [TagController::class, 'refresh']);
  Route::get('/tags/{tag}/edit', [TagController::class, 'edit']);
  Route::put('/tags/{tag}', [TagController::class, 'update']);
  Route::delete('/tags/{tag}', [TagController::class, 'destroy']);

  Route::post('/images', [ImageController::class, 'store']);
  Route::delete('/images/{tag}', [ImageController::class, 'destroy']);

  Route::get('/orders', [OrderController::class, 'index']);
  Route::get('/orders/p', [OrderController::class, 'paginationOrder']);
  Route::get('/orders/edit', [OrderController::class, 'edit']);
  Route::put('/orders/{order}', [OrderController::class, 'update']);
  Route::delete('/orders/{order}', [OrderController::class, 'destroy']);

  Route::get('/one-click-orders', [OneClickOrderController::class, 'index']);
  Route::get('/one-click-orders/p', [OneClickOrderController::class, 'paginationOrder']);
  Route::get('/one-click-orders/edit', [OneClickOrderController::class, 'edit']);
  Route::put('/one-click-orders/{order}', [OneClickOrderController::class, 'update']);
  Route::delete('/one-click-orders/{order}', [OneClickOrderController::class, 'destroy']);
});

require __DIR__.'/auth.php';
