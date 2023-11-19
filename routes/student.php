<?php

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\UnitController;
use Illuminate\Support\Facades\Route;

Route::get("/dashboard", [StudentController::class, "index"])->name("dashboard");

Route::get("/edit", [StudentController::class, "edit"])->name("edit");

Route::put("/update", [StudentController::class, "update"])->name("update");

Route::patch("/password", [StudentController::class, "password"])->name("password");


Route::prefix("/unit")->name("unit.")->group(function () {
    Route::get("/", [UnitController::class, "index"])->name("index");

    Route::get("/{unit}", [UnitController::class, "show"])->name("show");

    Route::get("/create/{school}", [UnitController::class, "create"])->name("create");

    Route::post('/store', [UnitController::class, "store"])->name("store");
});
