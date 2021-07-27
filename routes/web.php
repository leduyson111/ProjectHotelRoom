<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\Usercontroller;
use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class,'index'])->name('admin.home');
Route::group(['prefix' => 'laravel-filemanager' ], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('fake-login/{id}', function($id){  // đăng nhập bằng id kh cần mật khẩu
    $user =User::find($id);
    Auth::login($user);
    return redirect()->route('services');
});



Route::get('/login', [LoginController::class,'formLogin'])->name('login');
Route::post('/loginpost', [LoginController::class,'postLogin'])->name('postLogin');
Route::any('/logout', function(){
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::prefix('admin')->middleware('auth')->group(function(){
    Route::prefix('services')->group(function(){
        Route::get('/', [ServicesController::class,'index'])->name('services');
        Route::get('/add', [ServicesController::class,'add'])->name('services.add');
        Route::post('/store', [ServicesController::class,'store'])->name('services.store');
        Route::get('/edit/{id}', [ServicesController::class,'edit'])->name('services.edit');
        Route::post('/update/{id}', [ServicesController::class,'update'])->name('services.update');
        Route::get('/delete/{id}', [ServicesController::class,'delete'])->name('services.delete');
    });


    Route::prefix('rooms')->group(function(){
        Route::get('/', [RoomController::class,'index'])->name('rooms');
        Route::get('/add', [RoomController::class,'add'])->name('rooms.add');
        Route::post('/store', [RoomController::class,'store'])->name('rooms.store');
        Route::get('/edit/{id}', [RoomController::class,'edit'])->name('rooms.edit');
        Route::post('/update/{id}', [RoomController::class,'update'])->name('rooms.update');
        Route::get('/delete/{id}', [RoomController::class,'delete'])->name('rooms.delete');
    });

    Route::prefix('users')->group(function(){
        Route::get('/', [Usercontroller::class,'index'])->name('users');
        Route::get('/add', [Usercontroller::class,'add'])->name('users.add');
        Route::post('/store', [Usercontroller::class,'store'])->name('users.store');
        Route::post('/update/{id}', [Usercontroller::class,'update'])->name('users.update');
        Route::get('/delete/{id}', [Usercontroller::class,'delete'])->name('users.delete');
        Route::get('/user-profile-lite/{id}', [Usercontroller::class,'profile'])->name('users.profile');
    });

});
