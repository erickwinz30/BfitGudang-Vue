<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TestingController;

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

Route::middleware('isAdmin')->group(function () {
  Route::get('/', [StockController::class, 'index'])->name('home');
  Route::resource('/stocks', StockController::class)->names('stocks');
  Route::get('/entries-logs', [LogController::class, 'entriesIndex'])->name('entries-logs');
  Route::get('/reduce-logs', [LogController::class, 'reduceIndex'])->name('reduce-logs');

  Route::get('/entry/{id}', [StockController::class, 'entryForm']);
  Route::post('/entry/{id}', [StockController::class, 'storeEntry']);

  //reduce stock
  Route::get('/reduce/{id}', [StockController::class, 'reduceForm']);
  Route::post('/reduce/{id}', [StockController::class, 'storeReduce']);

  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);


Route::get('/dashboard', function () {
  return Inertia::render('Admin/Dashboard');
});
