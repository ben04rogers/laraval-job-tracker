<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

Route::get("/account", [AccountController::class, "index"])->name("account");


Route::get('calendar', [CalendarController::class, 'index'])->name("calendar")->middleware('auth');
Route::post('calendar-crud-ajax', [CalendarController::class, 'calendarEvents']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
