<?php

use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::get("/dashboard", [StudentController::class, "index"])->name("dashboard");

Route::get("/edit", [StudentController::class, "edit"])->name("edit");

Route::post("/update", [StudentController::class, "update"])->name("update");
