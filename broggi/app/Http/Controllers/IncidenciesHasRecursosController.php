<?php

namespace App\Http\Controllers;


use App\Models\Incidencies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\IncidenciesHasRecursos;

class IncidenciesHasRecursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('incidenciesHasRecursos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recursosId = Auth::user()->recursos_id;
        return view('incidenciesHasRecursos.create', compact('recursosId'));

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

     * @param  \App\Models\IncidenciesHasRecursos  $incidenciesHasRecursos
     * @return \Illuminate\Http\Response
     */
    public function show(IncidenciesHasRecursos $incidenciesHasRecursos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *

     * @param  \App\Models\IncidenciesHasRecursos  $incidenciesHasRecursos
     * @return \Illuminate\Http\Response
     */
    public function edit(IncidenciesHasRecursos $incidenciesHasRecursos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncidenciesHasRecursos  $incidenciesHasRecursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncidenciesHasRecursos $incidenciesHasRecursos)

    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *

     * @param  \App\Models\IncidenciesHasRecursos  $incidenciesHasRecursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncidenciesHasRecursos $incidenciesHasRecursos)

    {
        //
    }
}
