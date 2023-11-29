<?php

use App\Http\Controllers\Manger\SchoolClassController;
use Illuminate\Support\Facades\Route;

Route::prefix("/school/{school}/class")->name("class.")->group(function () {
    Route::get("/", [SchoolClassController::class, "index"])->name("index");
    Route::delete("/delete", [SchoolClassController::class, "destroy"])->name("destroy");
    Route::get("/edit/{class}", [SchoolClassController::class, "edit"])->name("edit");
    Route::put("/update/{class}", [SchoolClassController::class, "update"])->name("update");
    Route::post("/create", [SchoolClassController::class, "save"])->name("create");
});
