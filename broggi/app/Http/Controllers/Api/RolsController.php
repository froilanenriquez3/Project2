<?php

namespace App\Http\Controllers\Api;

use App\Models\Rols;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RolsResource;

class RolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rols= Rols::all();

        return RolsResource::collection($rols);
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
     * @param  \App\Models\Rols  $rols
     * @return \Illuminate\Http\Response
     */
    public function show(Rols $rols)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rols  $rols
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rols $rols)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rols  $rols
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rols $rols)
    {
        //
    }
}
