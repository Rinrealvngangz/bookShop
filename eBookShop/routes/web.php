<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DiscountController;
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


Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');



Auth::routes();
Route::middleware(['auth'])->group(function () {
    //admin
        Route::get('/admin', function () {
            return view('admin.index');
        })->name('admin.index');
        Route::resource('genres',GenresController::class);
        Route::resource('category',Controllers\CategoryController::class);
        Route::resource('product', ProductController::class);

    });

Route::middleware(['auth','role:administrator'])->group(function () {



    //product


    //user
        Route::resource('user',UserController::class);

    //role
        Route::resource('role',RoleController::class);


    //permission
        Route::resource('permission',PermissionController::class);
    //Add-Role-user
     Route::get('/user/{user}/role',[UserController::class, 'editRole'])->name('user.role');
     Route::put('/user/{user}/addRole',[UserController::class, 'addRole'])->name('user.addRole');
// DiscountController
Route::resource('discount',DiscountController::class);
        });

    });
