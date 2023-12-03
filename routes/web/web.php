<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use \App\Http\Controllers\Auth\Teacher\AuthenticatedSessionController as TeacherAuthenticatedSessionController;
use \App\Http\Controllers\Auth\Student\AuthenticatedSessionController as StudentAuthenticatedSessionController;
use \App\Http\Controllers\Auth\Teacher\NewPasswordController as TeacherNewPasswordController;
use \App\Http\Controllers\Auth\Teacher\PasswordResetLinkController as TeacherPasswordResetLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("/student")->name("student.")->middleware("guest:student")->group(function () {
    Route::get("login", [StudentAuthenticatedSessionController::class, "create"])->name("login");

    Route::post("login", [StudentAuthenticatedSessionController::class, "store"])->name("login");
});

Route::prefix("/teacher")->middleware(["guest:teacher"])->name("teacher.")->group(function () {
    Route::get("login", [TeacherAuthenticatedSessionController::class, "create"])->name("login");

    Route::post("login", [TeacherAuthenticatedSessionController::class, "store"])->name("login");

    Route::get('forgot-password', [TeacherPasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [TeacherPasswordResetLinkController::class, 'store'])
        ->name('password.phone');


    Route::get('reset-password', [TeacherNewPasswordController::class, "create"])
        ->middleware("VerifyCode")
        ->name("reset.password");

    Route::post('reset-password', [TeacherNewPasswordController::class, "store"])
        ->name("reset.store");

    Route::post("resend-code", [TeacherNewPasswordController::class, "resend"])
        ->middleware("VerifyCode")
        ->name("resend.code");


});


Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name("login");

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.phone');

    Route::get('reset-password', [NewPasswordController::class, 'create'])
        ->middleware("VerifyCode")
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::post("resend-code", [NewPasswordController::class, "resend"])
        ->middleware("VerifyCode")
        ->name("resend.code");
});

Route::middleware('auth')->group(function () {

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::get('/admin/dashboard', [AdminController::class, "index"])
    ->middleware(['auth',])->name('admin.dashboard');

Route::middleware([ 'auth'])->name("admin.")->prefix("/admin")->group(function () {
    Route::get('/profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');

    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

});
