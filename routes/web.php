<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::middleware(["isAdmin", 'auth'])->group(function () {
    Route::get('/profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AdminController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
