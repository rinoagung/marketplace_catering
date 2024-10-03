<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('auth')->group(function () {

    Route::get('/{hak_akses_id}/service', [ServiceController::class, "index"]);

    Route::resource('/service', ServiceController::class);
    // Route::delete('/antrian', [AntrianController::class, 'resetAntrian']);

    // Route::get('/{username}/edit', [ProfileController::class, "edit"]);
    // Route::put('/{username}/update', [ProfileController::class, "update"]);
    // Route::put('/{username}/changePassword', [ProfileController::class, "changePassword"]);
});


Route::middleware('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, "dashboardAdmin"]);

    Route::resource('/menu', MenuController::class);
    Route::resource('/hak_akses', HakAksesController::class);

    Route::get('/customers', [CustomerController::class, "customers"]);

    Route::get('/displayConfig', [DisplayController::class, "index"]);
    Route::put('/displayConfig', [DisplayController::class, "update"]);
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::get('/register', 'register')->name('register')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/signup', 'signup');
    Route::post('/logout', 'logout')->middleware('auth');
});
