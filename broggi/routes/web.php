<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarisController;
use App\Http\Controllers\RecursosController;
use App\Http\Controllers\AlertantsController;
use App\Http\Controllers\IncidenciesController;
use App\Http\Controllers\TipusRecursosController;
use App\Http\Controllers\TipusAlertantsController;

use App\Http\Controllers\Api\ApiIncidenciesController;


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

Route::get('/', function () {return view('login');})->name('login');
Route::post('/login', [UsuarisController::class, 'login']);
Route::get('/logout', [UsuarisController::class, 'logout']);


//Routes for pages that need to be accessed by login(all of them)
Route::middleware(['auth'])->group(function () {
    Route::resource('/incidencies', IncidenciesController::class);
    Route::resource('/alertants', AlertantsController::class);
    Route::resource('/recursos', RecursosController::class);
    Route::resource('/usuaris', UsuarisController::class);

    Route::resource('/tipusalertants', TipusAlertantsController::class);
    Route::resource('/tipusrecursos', TipusRecursosController::class);

    Route::get('/thome', function (){ return view('homePages.teleoperador');});
    Route::get('/rhome', function (){ return view('homePages.recurs');});
    Route::get('/ahome', function (){
        $view = view('login');
        if(Auth::user()->rols_id == 1){
            $view = view('homePages.admin');
        }
        return $view;
    });

});

Route::prefix('api')->group(function(){
    Route::apiResource('incidencies', ApiIncidenciesController::class);
});
