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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/ApiIndex', [ApiController::class, 'index']);
    Route::post('/ApiStore', [ApiController::class, 'store']);
    Route::put('/ApiUpdate/{id}', [ApiController::class, 'update']);
    Route::delete('/ApiDelete/{id}', [ApiController::class, 'destroy']);
});

Route::post('/ApiRegister', [ApiController::class, 'register']);
Route::post('/ApiLogin', [ApiController::class, 'login']);
