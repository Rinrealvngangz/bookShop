<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthorController;

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


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/product/{category}/{id}', [App\Http\Controllers\HomeController::class, 'getByCategory'])->name('home.product');
    Route::get('/product/new', [App\Http\Controllers\HomeController::class, 'getProductNew'])->name('home.productNew');
    Route::get('/product/sale', [App\Http\Controllers\HomeController::class, 'getProductSale'])->name('home.productSale');
    Route::get('/product/hot', [App\Http\Controllers\HomeController::class, 'getProductHot'])->name('home.productHot');
    Route::post('/product/search', [App\Http\Controllers\HomeController::class, 'findProduct'])->name('home.findProduct');
    Route::get('/home/{title}/{id}', [App\Http\Controllers\HomeController::class, 'getProduct'])->name('home.productDetail');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::get('/wishlist', [App\Http\Controllers\CartController::class, 'wishList'])->name('cart.wishList');
    Route::group(['middleware' => ['auth']],function (){
    Route::get('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/checkout/{id}/order', [App\Http\Controllers\CartController::class, 'order'])->name('cart.order');
    Route::post('/order/find/{id}/customer', [App\Http\Controllers\CartController::class, 'findOrder'])->name('cart.findOrder');
    Route::get('/sales/order/{id}/history', [App\Http\Controllers\CartController::class, 'salesOrder'])->name('cart.salesOrder');
    Route::get('/sales/order/{id}/customer/{idCustomer}', [App\Http\Controllers\CartController::class, 'salesOrderDetail'])->name('cart.salesOrderDetail');
    Route::post('/sales/order/{id}/customer/{idCustomer}', [App\Http\Controllers\CartController::class, 'updateSalesOrderDetail'])->name('cart.updateSalesOrderDetail');
    Route::delete('/sales/order/{id}/customer/{idCustomer}', [App\Http\Controllers\CartController::class, 'deleteSalesOrderDetail'])->name('cart.deleteSalesOrderDetail');
    Route::get('/customer/{id}/account/', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::post('/customer/{id}/account/update', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
    Route::get('/vnpay/return', [App\Http\Controllers\CartController::class, 'vnpayReturn'])->name('vnpay.return');

    });
Route::group(['middleware' => ['web']], function () {
    Route::post('/product/{id}/review', [App\Http\Controllers\HomeController::class, 'reviewProduct'])->name('home.review');

});
//Route::get('/product/{category}/{id}/{childCategory}/{childId}', [App\Http\Controllers\HomeController::class, 'getProductById'])->name('home.showProductByCategory');
Auth::routes();

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');



Auth::routes();

Route::group(['middleware' => ['auth','role:Superuser|Administrator|Manager|Accounting|Salesman|Staff|Inventory officer|HR']],function () {

    Route::resource('admin',Controllers\AdminController::class);
});

Route::group(['middleware' => ['auth','role:Administrator|Manager|Salesman|Staff']],function () {

    Route::resource('category',Controllers\CategoryController::class);
    Route::resource('author',AuthorController::class);
    Route::resource('publisher',Controllers\PublisherController::class);
    Route::resource('book',BookController::class);
    Route::resource('review',Controllers\ReviewController::class);
    Route::post('/book/site/{id}/file-delete',[BookController::class, 'deleteImage'])->name('book.deleteImage');
    Route::get('/book/{id}/discount',[BookController::class, 'discountBook'])->name('book.discount');
    Route::post('/book/{id}/discount/update',[BookController::class, 'updateDiscountBook'])->name('book.UpdateDiscount');
    Route::post('/book/import',[BookController::class, 'importExcel'])->name('book.import');

});
Route::group(['middleware' => ['auth','role:Administrator|Manager']],function () {
    Route::resource('user',UserController::class);

});

Route::group(['middleware' => ['auth','role:Administrator']],function () {
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::get('/user/{user}/role',[UserController::class, 'editRole'])->name('user.role');
    Route::post('/user/{user}/addRole',[UserController::class, 'addRole'])->name('user.addRole');
    Route::resource('payment',Controllers\PaymentController::class);
    Route::post('/payment/export',[Controllers\PaymentController::class, 'exportExcel'])->name('payment.export');
});
Route::group(['middleware' => ['auth','role:Superuser|Administrator|Manager|Accounting|Salesman|Inventory officer']],function () {
    Route::resource('order',OrderController::class);
    Route::delete('/order/{id}/customer/{idCustomer}/delete',[OrderController::class, 'orderDelete'])->name('order.orderDelete');
    Route::get('/order/{id}/customer/{idCustomer}/show',[OrderController::class, 'orderShow'])->name('order.orderShow');
});

