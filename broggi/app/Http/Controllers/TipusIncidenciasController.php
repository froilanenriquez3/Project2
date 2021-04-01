<?php

namespace App\Http\Controllers;

use App\Models\Tipus_incidencias;
use Illuminate\Http\Request;

class TipusIncidenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tiposRecursos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipus_incidencias  $tipus_incidencias
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipus_incidencias $tipus_incidencias)
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
