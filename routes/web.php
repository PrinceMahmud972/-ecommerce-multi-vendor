<?php

use App\Http\Controllers\Admin\AdminController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login', [AdminController::class, 'login'])->name('login');
    Route::post('login', [AdminController::class, 'postLogin'])->name('postLogin');

    Route::middleware('admin')->group(function() {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('logout', [AdminController::class, 'logout'])->name('logout');

        // Profile Section - change password
        Route::get('changePassword', [AdminController::class, 'changePassword'])->name('changePassword');
        Route::put('changePassword', [AdminController::class, 'updateChangePassword'])->name('updateChangePassword');

        // Profile Section - edit profile
        Route::get('profile', [AdminController::class, 'editProfile'])->name('editProfile');
        Route::put('profile', [AdminController::class, 'updateProfile'])->name('updateProfile');
    });
});