<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarisController;
use App\Http\Controllers\Api\RecursosController;
use App\Http\Controllers\Api\AlertantsController;
use App\Http\Controllers\Api\IncidenciesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('usuaris', UsuarisController::class);
Route::apiResource('incidencies', IncidenciesController::class);
Route::apiResource('alertants', AlertantsController::class);
Route::apiResource('recursos', RecursosController::class);
