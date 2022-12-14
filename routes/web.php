<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PincodeController;
use App\Http\Controllers\Admin\RegisterController;

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

Route::get('/register', [RegisterController::class, 'index'])->middleware('alreadylogedin')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');


Route::get('/', [LoginContoller::class, 'index'])->name('login')->middleware('alreadylogedin');
Route::post('/login/check', [LoginContoller::class, 'user_check'])->middleware('alreadylogedin')->name('login-check');
Route::get('/forgot_password', [LoginContoller::class, 'forgotpass'])->middleware('alreadylogedin')->name('forgotpass');
Route::post('/send_email', [LoginContoller::class, 'send_email'])->name('send.email')->middleware('alreadylogedin');
Route::get('/resetpassword/{token}', [LoginContoller::class, 'reset_password'])->middleware('alreadylogedin')->name('reset.password');
Route::post('/change_password', [LoginContoller::class, 'change_password'])->middleware('alreadylogedin')->name('change.pass');

Route::middleware(['isLogedIn'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin-dashboard');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/index', 'index')->name('category_list');
        Route::post('/datatable', 'datatable')->name('category.datatable');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/destroy', 'destroy')->name('destroy');
        Route::get('/createPdf', 'createPdf')->name('createPdf');
    });
});

// use prefix

Route::group(['as' => 'pincode.', 'prefix' => 'pincode', 'middleware' => ['isLogedIn']], function () {
    Route::controller(PincodeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/state/{id?}','state')->name('state');
        Route::post('/city/{id?}','city')->name('city');
    });
});

Route::get('/logout', [LoginContoller::class, 'logout'])->name('logout');
