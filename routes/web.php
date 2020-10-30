<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Order\OrdersController;
use App\Http\Controllers\Api\Product\ProductsController;
use App\Http\Controllers\Api\User\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
});

Route::group(['middleware' => 'apiJwtProtectRoutes', 'prefix' => 'api'], function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::resource('products', ProductsController::class);

    Route::post('orders', [OrdersController::class, 'store']);
    Route::get('orders', [OrdersController::class, 'index'])
        ->middleware('CheckIfUserRoleIsSeller');
});
// Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
