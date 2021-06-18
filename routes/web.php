<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CargoController;
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

Route::get('/', [CargoController::class, 'index'])->name('cargo.index');
Route::get('/{id}', [CargoController::class, 'show'])->name('cargo.show');
Route::post('/', [CargoController::class, 'store'])->name('cargo.store');
Route::put('/{id}', [CargoController::class, 'update'])->name('cargo.update');
Route::delete('/{id}', [CargoController::class, 'destroy'])->name('cargo.destroy');
