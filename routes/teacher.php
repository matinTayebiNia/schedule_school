<?php

use App\Http\Controllers\Auth\Teacher\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Teacher\ConformablePasswordController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\UnitController;
use Illuminate\Support\Facades\Route;


Route::get("/dashboard", [TeacherController::class, "index"])->name("dashboard");

Route::get('/profile', [TeacherController::class, 'edit'])->name('profile.edit');

Route::patch('/profile', [TeacherController::class, 'update'])->name('profile.update');

Route::post("/logout", [AuthenticatedSessionController::class, "destroy"])
    ->name("logout");

Route::get("/confirm", [ConformablePasswordController::class, "show"])->name("password.confirm");

Route::post("/confirm", [ConformablePasswordController::class, "store"])->name("password.confirm");

Route::put('/password', [TeacherController::class, 'password'])->name('password.update');

Route::prefix("/units")->middleware("password.confirm:teacher.password.confirm")->name("units.")->group(function () {
    Route::get("/", [UnitController::class, "index"])->name("index");
    Route::get("/show/{unit}", [UnitController::class, "show"])->name("show");
});
