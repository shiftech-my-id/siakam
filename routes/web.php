<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StudentBillController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UserActivityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\AuthController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyGuest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.public.home');
})->name('home');

Route::get('/kontak-kami', function () {
    return view('pages.public.contact');
})->name('contact');

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::match(['GET', 'POST'], 'login', 'login')->middleware([OnlyGuest::class])
        ->name('auth.login');
        Route::match(['GET', 'POST'], 'logout', 'logout')->name('auth.logout');
});

Route::middleware([Authenticate::class])->prefix('admin')->group(function () {
    Route::controller(SettingsController::class)->prefix('settings')->group(function () {
        Route::get('', 'edit');
        Route::post('save', 'save');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::match(['get', 'post'], 'delete/{id}', 'delete');
        Route::match(['get', 'post'], 'profile', 'profile');
    });

    Route::controller(UserActivityController::class)->prefix('user-activity')->group(function () {
        Route::get('', 'index');
        Route::get('show/{id}', 'show');
        Route::get('delete/{id}', 'delete');
        Route::match(['get', 'post'], 'clear', 'clear');
    });

    Route::get('/', [DashboardController::class, 'index']);

    Route::controller(StudentController::class)->prefix('admin/student')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('duplicate/{id}', 'duplicate');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
        Route::post('action/{id}', 'action');
        Route::get('restore/{id}', 'restore');
        Route::get('print/{id}', 'print');
    });

    Route::controller(StudentBillController::class)->prefix('admin/student-bill')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('duplicate/{id}', 'duplicate');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
        Route::post('action/{id}', 'action');
        Route::get('restore/{id}', 'restore');
        Route::get('print/{id}', 'print');
    });
});
