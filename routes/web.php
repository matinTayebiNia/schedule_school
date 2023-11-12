<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\PasswordController;
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

Route::get('/admin/dashboard',[AdminController::class,"index"])
    ->middleware(['auth', "isAdmin"])->name('admin.dashboard');

Route::middleware(["isAdmin", 'auth'])->name("admin.")->prefix("/admin")->group(function () {
    Route::get('/profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

});

require __DIR__ . '/auth.php';
