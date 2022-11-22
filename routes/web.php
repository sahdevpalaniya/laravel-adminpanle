<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/', [LoginContoller::class, 'index'])->name('login')->middleware('alreadylogedin');
Route::post('/login/check', [LoginContoller::class, 'user_check'])->name('login-check');
Route::get('/forgot_password', [LoginContoller::class, 'forgotpass'])->name('forgotpass');
Route::post('/send_email', [LoginContoller::class, 'send_email'])->name('send.email');
Route::get('/resetpassword/{token}', [LoginContoller::class, 'reset_password'])->name('reset.password');
Route::post('/change_password', [LoginContoller::class, 'change_password'])->name('change.pass');

Route::middleware(['isLogedIn'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin-dashboard');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/index', 'index')->name('category_list');
        Route::post('/datatable', 'datatable')->name('category.datatable');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/destroy', 'destroy')->name('destroy');

    });
});

Route::get('/logout', [LoginContoller::class, 'logout'])->name('logout');
