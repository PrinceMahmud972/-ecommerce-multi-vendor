<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\VendorController as AdminVendorController;
use App\Http\Controllers\Vendor\VendorController;
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

        // Section
        Route::get('section', [SectionController::class, 'index'])->name('section.index');
        Route::get('section/create', [SectionController::class, 'create'])->name('section.create');
        Route::post('section', [SectionController::class, 'store'])->name('section.store');
        Route::get('section/{section}/edit', [SectionController::class, 'edit'])->name('section.edit');
        Route::put('section/{section}', [SectionController::class, 'update'])->name('section.update');
        Route::delete('section/{section}', [SectionController::class, 'destroy'])->name('section.destroy');

        // Category
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

        // Vendor
        Route::get('vendor', [AdminVendorController::class, 'index'])->name('vendor.index');
        Route::delete('vendor/{vendor}', [AdminVendorController::class, 'destroy'])->name('vendor.destroy');
        Route::put('vendor/{vendor}/enable', [AdminVendorController::class, 'enable'])->name('vendor.enable');
        Route::put('vendor/{vendor}/disable', [AdminVendorController::class, 'disable'])->name('vendor.disable');

        // Profile - change password
        Route::get('changePassword', [AdminController::class, 'changePassword'])->name('changePassword');
        Route::put('changePassword', [AdminController::class, 'updateChangePassword'])->name('updateChangePassword');
        Route::get('profile', [AdminController::class, 'editProfile'])->name('editProfile');
        Route::put('profile', [AdminController::class, 'updateProfile'])->name('updateProfile');

    });
});

Route::prefix('vendor')->name('vendor.')->group(function() {
    Route::get('register', [VendorController::class, 'register'])->name('register');
    Route::post('register', [VendorController::class, 'storeRegister'])->name('storeRegister');
    Route::get('login', [VendorController::class, 'login'])->name('login');
    Route::post('login', [VendorController::class, 'postLogin'])->name('postLogin');

    Route::middleware('vendor')->group(function () {
        Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
        Route::get('logout', [VendorController::class, 'logout'])->name('logout');

        Route::get('changePassword', [VendorController::class, 'changePassword'])->name('changePassword');
        Route::put('changePassword', [VendorController::class, 'updateChangePassword'])->name('updateChangePassword');
        Route::get('profile', [VendorController::class, 'editProfile'])->name('editProfile');
        Route::put('profile', [VendorController::class, 'updateProfile'])->name('updateProfile');

    });
});