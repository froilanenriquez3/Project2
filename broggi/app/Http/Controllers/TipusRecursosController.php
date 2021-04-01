<?php

namespace App\Http\Controllers;

use App\Models\Tipus_recursos;
use Illuminate\Http\Request;

class TipusRecursosController extends Controller
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
     * @param  \App\Models\Tipus_recursos  $tipus_recursos
     * @return \Illuminate\Http\Response
     */
    public function show(Tipus_recursos $tipus_recursos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipus_recursos  $tipus_recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipus_recursos $tipus_recursos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipus_recursos  $tipus_recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipus_recursos $tipus_recursos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipus_recursos  $tipus_recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipus_recursos $tipus_recursos)
    {
        //
    }
}
