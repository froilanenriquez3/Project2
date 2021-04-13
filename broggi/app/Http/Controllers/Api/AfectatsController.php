<?php

namespace App\Http\Controllers\Api;

use App\Models\Afectats;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AfectatsResource;

class AfectatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $afectats = Afectats::all();
        return AfectatsResource::collection($afectats);
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
     * @param  \App\Models\Afectats  $afectats
     * @return \Illuminate\Http\Response
     */
    public function show(Afectats $afectats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Afectats  $afectats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afectats $afectats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Afectats  $afectats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Afectats $afectats)
    {
        //
    }
}
