<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\ReservController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AccueilController::class, 'index']);

Route::resource('client', ClientController::class);
Route::resource('salle', SalleController::class);
Route::resource('reservation', ReservController::class);
