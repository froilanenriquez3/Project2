<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Tipus_incidencias;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipusIncidenciesResource;

class TipusIncidenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipus_incidencies= Tipus_incidencias::all();

        return TipusIncidenciesResource::collection($tipus_incidencies);
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
     * @param  \App\Models\Tipus_incidencias  $tipus_incidencias
     * @return \Illuminate\Http\Response
     */
    public function show(Tipus_incidencias $tipus_incidencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipus_incidencias  $tipus_incidencias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipus_incidencias $tipus_incidencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipus_incidencias  $tipus_incidencias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipus_incidencias $tipus_incidencias)
    {
        //
    }
}
