<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FurloughType;
use App\Http\Controllers\Admin\FurloughTypeController;
use App\Http\Controllers\Admin\OccupationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('login-page');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login-process');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('employee')->middleware('employee')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('employee.dashboard');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('occupation')->group(function () {
        Route::get('/', [OccupationController::class, 'index'])->name('admin.occupation.index');
        Route::get('create', [OccupationController::class, 'create'])->name('admin.occupation.create');
        Route::post('store', [OccupationController::class, 'store'])->name('admin.occupation.store');
        Route::get('{occupation}/edit', [OccupationController::class, 'edit'])->name('admin.occupation.edit');
        Route::patch('{occupation}/update', [OccupationController::class, 'update'])->name('admin.occupation.update');
        Route::delete('{occupation}/delete', [OccupationController::class, 'destroy'])->name('admin.occupation.delete');
    });

    Route::prefix('furlough-types')->group(function () {
        Route::get('/', [FurloughTypeController::class, 'index'])->name('admin.furlough-types.index');
        Route::get('create', [FurloughTypeController::class, 'create'])->name('admin.furlough-types.create');
        Route::post('store', [FurloughTypeController::class, 'store'])->name('admin.furlough-types.store');
        Route::get('{furloughType}/edit', [FurloughTypeController::class, 'edit'])->name('admin.furlough-types.edit');
        Route::patch('{furloughType}/update', [FurloughTypeController::class, 'update'])->name('admin.furlough-types.update');
        Route::delete('{furloughType}/delete', [FurloughTypeController::class, 'destroy'])->name('admin.furlough-types.delete');
    });
});
