<?php

namespace App\Http\Controllers\Api;

use App\Models\Recursos;
use App\Models\Incidencies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        //
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
