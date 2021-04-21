<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UsuarisController;
use App\Http\Controllers\RecursosController;
use App\Http\Controllers\AlertantsController;
use App\Http\Controllers\IncidenciesController;
use App\Http\Controllers\TipusRecursosController;

use App\Http\Controllers\TipusAlertantsController;
use App\Http\Controllers\Api\ApiIncidenciesController;
use App\Http\Controllers\IncidenciesHasRecursosController;

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

    /* Routes that require the user to be admin or CECOS */
    Route::middleware(['role:1,2'])->group(function () {
        Route::get('/thome', function (){ return view('homePages.teleoperador');});
        Route::resource('/incidencies', IncidenciesController::class);
        Route::resource('/alertants', AlertantsController::class);
        Route::resource('/tipusalertants', TipusAlertantsController::class);
        Route::resource('/recursos', RecursosController::class);
    });

    /* Routes that require the user to be admin or Recurs */
    Route::middleware(['role:1,3'])->group(function () {
        Route::get('/rhome', function (){ return view('homePages.recurs');});
        Route::resource('/incidenciesrecursos', IncidenciesHasRecursosController::class);
    });

    /* Admin routes */
    Route::middleware(['role:1'])->group(function(){
        Route::get('/ahome',function (){ return view('homePages.admin'); });
        Route::resource('/usuaris', UsuarisController::class);
        Route::resource('/tipusrecursos', TipusRecursosController::class);
    });

});

Route::prefix('api')->group(function(){
    Route::apiResource('incidencies', ApiIncidenciesController::class);
});

Route::get('/clearcache', function() {

    $notice = 'CONFIG';
    // Laravel Clear CONFIG Cache On Shared Hosting
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');

    $notice.= ' / APPLICATION';
    // Laravel Clear APPLICATION Cache On Shared Hosting
    $exitCode = Artisan::call('cache:clear');

    $notice.= ' / VIEW';
    // Laravel Clear VIEW Cache On Shared Hosting
    $exitCode = Artisan::call('view:clear');

    // $notice.= ' / ROUTE';
     // Laravel Clear ROUTE Cache On Shared Hosting
    // $exitCode = Artisan::call('route:cache');

    $notice.= ' cleared';

    return $notice;
});
