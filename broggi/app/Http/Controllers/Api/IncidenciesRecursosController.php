<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Recursos;
use App\Models\Incidencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\RecursosResource;
use App\Http\Resources\IncidenciesResource;

class IncidenciesRecursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidencies= Incidencies::all();

        return IncidenciesResource::collection($incidencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recursos  $recurso
     * @return \Illuminate\Http\Response
     */
    public function show(Recursos $recurso)
    {
        $recurso = Recursos::with(['incidencies_has_recursos.incidencies', 'incidencies_has_recursos.afectats', 'tipus_recursos'])->find($recurso->id);
        return new RecursosResource($recurso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencies  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencies $incidencies)
    {
        DB::beginTransaction();

        $array = $request->input('incidencies_has_recursos');

        try{
            $ihr = $array[0];


            $incidencies->incidencies_has_recursos()->save($ihr);
            DB::commit();
            $incidencies->refresh();

            $response = (new IncidenciesResource($incidencies))
                    ->response()
                    ->setStatusCode(201);
        } catch (QueryException $ex) {
            DB::rollBack();
            $message = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $message], 400);

        }


        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencies  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencies $incidencies)
    {
        //
    }
}
