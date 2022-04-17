<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard")->middleware('auth');
Route::post("/dashboard", [DashboardController::class, "store"]);

Route::get("/files", [FilesController::class, "index"])->name("files")->middleware('auth');
Route::post("/files/{id?}", [FilesController::class, "store"])->name("uploadfile");
Route::delete("/files/delete/{id}", [FilesController::class, "delete"])->name("deletefile");

Route::get("/files/download/{file}", [FilesController::class, "download"]);
Route::get("/files/view/{id}", [FilesController::class, "view"]);

Route::get("/jobs/{id}/details", [JobController::class, "index"])->name("job");
Route::delete("/delete/job/{id}", [JobController::class, "delete"])->name("deletejob");
Route::put("/jobs/{id}/update", [JobController::class, "update"])->name("updatejob");

Route::put("todo/update", [TodoController::class, "updateTodo"])->name("updatetodo");
Route::post("todo/{id}/add", [TodoController::class, "addtodo"])->name("addtodo");

Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class, "store"]);

Route::post("/logout", [LogoutController::class, "store"])->name("logout");

Route::get("/register", [RegisterController::class, "index"])->name("register");
Route::post("/register", [RegisterController::class, "store"]);

Route::get('calendar', [CalendarController::class, 'index'])->name("calendar")->middleware('auth');
Route::post('calendar-crud-ajax', [CalendarController::class, 'calendarEvents']);

