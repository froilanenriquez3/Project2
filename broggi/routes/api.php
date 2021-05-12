<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolsController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\UsuarisController;
use App\Http\Controllers\Api\AfectatsController;
use App\Http\Controllers\Api\QuestionController;
// use App\Http\Controllers\Api\IncidenciesController;
use App\Http\Controllers\Api\RecursosController;
use App\Http\Controllers\Api\AlertantsController;
use App\Http\Controllers\Api\IncidenciesRecursosController;
use App\Http\Controllers\Api\MunicipisController;
use App\Http\Controllers\Api\TipusRecursController;
use App\Http\Controllers\Api\TipusAlertantsController;
use App\Http\Controllers\Api\TipusIncidenciesController;
use App\Models\Incidencies;

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
Route::post('usuaris/update/{usuari}', [UsuarisController::class, 'update']);
Route::post('usuaris/delete/{usuari}', [UsuarisController::class, 'destroy']);

//Mirar porque está
// Route::apiResource('incidencies', ApiIncidenciesController::class);
// Route::post('incidencies/update', [ApiIncidenciesController::class, 'update']);
// Route::post('incidencies/delete', [ApiIncidenciesController::class, 'destroy']);

Route::apiResource('alertants', AlertantsController::class);
Route::post('alertants/update/{alertant}', [AlertantsController::class, 'update']);
Route::post('alertants/delete/{alertant}', [AlertantsController::class, 'destroy']);

Route::apiResource('afectats', AfectatsController::class);
Route::post('afectats/update/{afectat}', [AfectatsController::class, 'update']);
Route::post('afectats/delete/{afectat}', [AfectatsController::class, 'destroy']);

Route::apiResource('recursos', RecursosController::class);
Route::post('recursos/update/{recurso}', [RecursosController::class, 'update']);
Route::post('recursos/delete/{recurso}', [RecursosController::class, 'destroy']);

Route::apiResource('tipusrecursos', TipusRecursController::class);
Route::post('tipusrecursos/update/{tipusrecurso}', [TipusRecursController::class, 'update']);
Route::post('tipusrecursos/delete/{tipusrecurso}', [TipusRecursController::class, 'destroy']);


Route::apiResource('tipusalertants', TipusAlertantsController::class);
Route::post('tipusalertants/update/{tipusrecurso}', [TipusAlertantsController::class, 'update']);
Route::post('tipusalertants/delete/{tipusrecurso}', [TipusAlertantsController::class, 'destroy']);

Route::apiResource('municipis', MunicipisController::class);
Route::post('municipis/update/{municipi}', [MunicipisController::class, 'update']);
Route::post('municipis/delete/{municipi}', [MunicipisController::class, 'destroy']);

Route::apiResource('rols', RolsController::class);
Route::post('rols/update/{rol}', [RolsController::class, 'update']);
Route::post('rols/delete/{rol}', [RolsController::class, 'destroy']);

Route::apiResource('questions', QuestionController::class);
Route::post('questions/update/{question}', [QuestionController::class, 'update']);
Route::post('questions/delete/{question}', [QuestionController::class, 'destroy']);

Route::apiResource('answers', AnswerController::class);
Route::post('answers/update/{answer}', [AnswerController::class, 'update']);
Route::post('answers/delete/{answer}', [AnswerController::class, 'destroy']);

Route::apiResource('tipusincidencies', TipusIncidenciesController::class);
Route::post('tipusincidencies/update', [TipusIncidenciesController::class, 'update']);
Route::post('tipusincidencies/delete', [TipusIncidenciesController::class, 'destroy']);

Route::apiResource('afectats', AfectatsController::class);
Route::post('afectats/update', [AfectatsController::class, 'update']);
Route::post('afectats/delete', [AfectatsController::class, 'destroy']);

Route::apiResource('incidenciesrecursos', IncidenciesRecursosController::class);
Route::post('incidenciesrecursos/update', [IncidenciesRecursosController::class, 'update']);
Route::post('incidenciesrecursos/delete', [IncidenciesRecursosController::class, 'destroy']);

// Route::delete('incidenciesrecursos/{incidenciesrecurso}/{recurs_id}',[IncidenciesRecursosController::class, 'destroy'] );
Route::post('incidenciesrecursos/{incidenciesrecurso}/{recurs_id}',[IncidenciesRecursosController::class, 'destroy'] );

