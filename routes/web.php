<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//==================================== Admin Route Here ===================================================//
Route::get('/admin',[\App\Http\Controllers\Admin\AdminController::class,'admin'])->name('admin');

//==================================== Admin Dashboard Route section ==========================================//
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function(){

    Route::resource('banner', \App\Http\Controllers\Admin\BannerController::class);
    Route::post('banner/status', [\App\Http\Controllers\Admin\BannerController::class,'bannerStatus'])->name('banner.status');
});
