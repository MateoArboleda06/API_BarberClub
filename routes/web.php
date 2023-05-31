<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\WebController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/', 'welcome');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::view('dashboard', 'dashboard')->middleware('auth');

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::view('register', 'register')->name('register')->middleware('guest');

Route::post('register', [LoginController::class, 'register']);

Route::get('reservas', [WebController::class, 'create'])->name('reservas');
Route::post('guardar_reserva', [WebController::class, 'store'])->name('guardar_reserva');
Route::get('mis_reservas/{usuario}', [WebController::class, 'misReservas'])->name('mis_reservas');
Route::post('eliminar_reserva', [WebController::class, 'destroy'])->name('eliminar_reserva');
Route::get('editar/{reserva}', [WebController::class, 'edit'])->name('editar');
Route::post('guardar_ediccion_reserva', [WebController::class, 'update'])->name('guardar_ediccion_reserva');
