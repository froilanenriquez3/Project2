<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolsController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\UsuarisController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\RecursosController;
// use App\Http\Controllers\Api\IncidenciesController;
use App\Http\Controllers\Api\AlertantsController;
use App\Http\Controllers\Api\MunicipisController;
use App\Http\Controllers\Api\TipusRecursController;
use App\Http\Controllers\Api\TipusAlertantsController;
use App\Http\Controllers\Api\TipusIncidenciesController;

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
// Route::apiResource('incidencies', IncidenciesController::class);
Route::apiResource('alertants', AlertantsController::class);
Route::apiResource('recursos', RecursosController::class);
Route::apiResource('tipusrecursos', TipusRecursController::class);
Route::apiResource('tipusalertants', TipusAlertantsController::class);
Route::apiResource('municipis', MunicipisController::class);
Route::apiResource('rols', RolsController::class);
Route::apiResource('questions', QuestionController::class);
Route::apiResource('answers', AnswerController::class);
Route::apiResource('tipusincidencies', TipusIncidenciesController::class);
