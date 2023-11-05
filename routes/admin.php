<?php


use App\Http\Controllers\Admin\LessenController;
use App\Http\Controllers\Admin\Permission\UserController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Livewire\Admin\Lessen\CreateLessen;
use App\Livewire\Admin\Lessen\EditLessen;
use App\Livewire\Admin\School\CreateSchool;
use App\Livewire\Admin\School\EditSchool;
use App\Livewire\Admin\Student\CreateStudent;
use App\Livewire\Admin\Student\EditStudent;
use App\Livewire\Admin\Teacher\Create as CreateTeacher;
use App\Livewire\Admin\Teacher\Edit as EditTeacher;
use App\Livewire\Admin\UserAdmin\CreateAdminUser;
use App\Livewire\Admin\UserAdmin\EditAdminUser;
use Illuminate\Support\Facades\Route;


Route::prefix("/teacher")->name("teacher.")->group(function () {
    Route::get("/", [TeacherController::class, "index"])->name("index");
    Route::delete("/delete", [TeacherController::class, "destroy"])->name("destroy");
    Route::get("/show/{teacher}", [TeacherController::class, "show"])->name("show");
    Route::get("/edit/{teacher}", EditTeacher::class)->name("edit");
    Route::get("/create", CreateTeacher::class)->name("create");
});

Route::prefix("/student")->name("student.")->group(function () {
    Route::get("/", [StudentController::class, "index"])->name("index");
    Route::delete("/delete", [StudentController::class, "destroy"])->name("destroy");
    Route::get("/show/{student}", [StudentController::class, "show"])->name("show");
    Route::get("/edit/{student}", EditStudent::class)->name("edit");
    Route::get("/create", CreateStudent::class)->name("create");
});

Route::prefix("/lessen")->name("lessen.")->group(function () {
    Route::get("/", [LessenController::class, "index"])->name("index");
    Route::delete("/delete", [LessenController::class, "destroy"])->name("destroy");
    Route::get("/edit/{lessen}", EditLessen::class)->name("edit");
    Route::get("/create", CreateLessen::class)->name("create");
});

Route::prefix("/school")->name("school.")->group(function () {
    Route::get("/", [SchoolController::class, "index"])->name("index");
    Route::delete("/delete", [SchoolController::class, "destroy"])->name("destroy");
    Route::get("/show/{school}", [SchoolController::class, "show"])->name("show");
    Route::get("/edit/{school}", EditSchool::class)->name("edit");
    Route::get("/create", CreateSchool::class)->name("create");
});

Route::prefix("/school/{school}/class")->name("class.")->group(function () {
    Route::get("/", [SchoolClassController::class, "index"])->name("index");
    Route::delete("/delete", [SchoolClassController::class, "destroy"])->name("destroy");
    Route::get("/edit/{class}", [SchoolClassController::class,"edit"])->name("edit");
    Route::put("/update/{class}", [SchoolClassController::class,"update"])->name("update");
    Route::post("/create", [SchoolClassController::class,"save"])->name("create");
});

Route::prefix("/users")->name("users.")->group(function (){
    Route::get("/", [UserController::class, "index"])->name("index");
    Route::delete("/delete", [UserController::class, "destroy"])->name("destroy");
    Route::post("/create", CreateAdminUser::class)->name("create");
    Route::get("/edit/{user}", EditAdminUser::class)->name("edit");
});

