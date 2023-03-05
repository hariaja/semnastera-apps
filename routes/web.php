<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Pappers\JournalController;
use App\Http\Controllers\Pappers\TransactionController;
use App\Http\Controllers\Pappers\RegistrationController;

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
  return redirect(RouteServiceProvider::HOME);
});

Auth::routes(['verify' => true]);

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'permission', 'verified'])->group(function () {

  # Settings
  Route::prefix('settings')->group(function () {
    Route::resource('roles', RoleController::class)->except('show');
    Route::post('users/password', [UserController::class, 'password'])->name('users.password');
    Route::resource('users', UserController::class)->except('create', 'store');
  });

  # Pappers
  Route::prefix('pappers')->group(function () {
    Route::resource('journals', JournalController::class);
    Route::resource('registrations', RegistrationController::class)->except('show');
    Route::resource('transactions', TransactionController::class)->except('destroy', 'update');
  });
});
