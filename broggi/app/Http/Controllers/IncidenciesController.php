<?php

namespace App\Http\Controllers;

use App\Models\Incidencies;
use Illuminate\Http\Request;

class IncidenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('incidencies/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incidencies/create');
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
     * @param  \App\Models\Incidencies  $incidency
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencies $incidency)
    {
        return view('incidencies/' + $incidency);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencies  $incidency
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencies $incidency)
    {
        return view('incidencies/show', compact('incidency'));
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
