<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::Get('/ApiIndex',[ApiController::class, 'index']);
Route::POST('/ApiStore',[ApiController::class, 'store']);
Route::PUT('/ApiUpdate/{id}',[ApiController::class, 'update']);
Route::DELETE('/ApiDelete/{id}',[ApiController::class, 'destroy']);
Route::POST('/ApiRegister',[ApiController::class, 'register']);
Route::POST('/ApiLogin',[ApiController::class, 'login']);
