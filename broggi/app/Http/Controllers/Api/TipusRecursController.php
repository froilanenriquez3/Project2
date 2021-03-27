<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Tipus_recursos;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipusRecursosResource;

class TipusRecursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recursos= Tipus_Recursos::all();

        return TipusRecursosResource::collection($recursos);
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
