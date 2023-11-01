<?php


use App\Http\Controllers\Admin\TeacherController;
use App\Livewire\Admin\Teacher\Create as CreateTeacher;
use App\Livewire\Admin\Teacher\Edit as EditTeacher;
use Illuminate\Support\Facades\Route;


Route::prefix("/teacher")->name("teacher.")->group(function () {
    Route::get("/", [TeacherController::class, "index"])->name("index");
    Route::delete("/delete", [TeacherController::class, "destroy"])->name("destroy");
    Route::get("/show/{teacher}", [TeacherController::class, "show"])->name("show");
    Route::get("/edit/{teacher}", EditTeacher::class)->name("edit");
    Route::get("/create", CreateTeacher::class)->name("create");
});
