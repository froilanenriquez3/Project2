<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarisController;
use App\Http\Controllers\RecursosController;
use App\Http\Controllers\AlertantsController;
use App\Http\Controllers\IncidenciesController;

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

Route::get('/', function () {return view('login');});

Route::resource('/incidencies', IncidenciesController::class);

Route::resource('/alertantsHabituales', AlertantsController::class);

Route::resource('/recursos', RecursosController::class);

Route::resource('/usuaris', UsuarisController::class);

//Possibly missing: route for Incidencies has recursos
