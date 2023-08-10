<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\Admin\BannerControllerAdmin;
use App\Http\Controllers\Admin\DashboardControllerAdmin;
use App\Http\Controllers\Admin\CategoryControllerAdmin;
use App\Http\Controllers\Admin\ProductGalleryControllerAdmin;
use App\Http\Controllers\Admin\ProductControllerAdmin;
use App\Http\Controllers\Admin\UserControllerAdmin;
use App\Http\Controllers\Admin\TransactionControllerAdmin;


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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [DetailController::class, 'add'])->name('detail-add');

Route::get('/success', [CartController::class,'success'])->name('success');
Route::post('/checkout/callback', [CheckoutController::class,'callback'])->name('midtrans-callback');
Route::get('/register/success', [RegisteredUserController::class,'success'])->name('register-success');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])
        ->name('dashboard-product');
    Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])
        ->name('dashboard-product-create');
    Route::post('/dashboard/products', [DashboardProductController::class, 'store'])
        ->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', [DashboardProductController::class, 'details'])
        ->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', [DashboardProductController::class, 'update'])
        ->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])
        ->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])
        ->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])
        ->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])
        ->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'update'])
        ->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])
        ->name('dashboard-settings-store');
    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])
        ->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class, 'update'])
        ->name('dashboard-settings-redirect');

});

Route::prefix('admin')->middleware(['auth','admin'])
    ->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', CategoryControllerAdmin::class);
        Route::resource('user', UserControllerAdmin::class);
        Route::resource('product', ProductControllerAdmin::class);
        Route::resource('product-gallery', ProductGalleryControllerAdmin::class);
        Route::resource('transaction', TransactionControllerAdmin::class);
    });

Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
