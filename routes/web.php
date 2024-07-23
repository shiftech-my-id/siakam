<?php

use App\Http\Controllers\StudentBillController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.public.home');
})->name('home');

Route::get('/kontak-kami', function () {
    return view('pages.public.contact');
})->name('contact');

Route::match(['GET', 'POST'], '/login-wali-santri', function () {
    return view('pages.student.auth.login');
})->name('student.auth.login');

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
