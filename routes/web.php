<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;

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


// route for guess seeing welcome page
Route::get('/', function () {
    return view('welcome');
})-> name('welcome');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::GET('/dashboard',[DriverController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::POST('store',[DriverController::class, 'store'])->name('store');
    Route::PUT('update/{id}',[DriverController::class, 'update'])->name('update');
    Route::DELETE('delete/{id}',[DriverController::class, 'destroy'])->name('delete');
});

require __DIR__.'/auth.php';
