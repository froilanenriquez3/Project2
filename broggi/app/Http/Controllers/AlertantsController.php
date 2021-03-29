<?php

namespace App\Http\Controllers;

use App\Models\Alertants;
use Illuminate\Http\Request;

class AlertantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alertants = Alertants::paginate(4);

        return view('alertantesHabituales.index', compact('alertants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insert = 'true';

        return view('alertantesHabituales.createvue', compact('insert'));
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
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function show(Alertants $alertants)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alertants  $alertant
     * @return \Illuminate\Http\Response
     */
    public function edit(Alertants $alertant)
    {
        $insert = 'false';
        return view('alertantesHabituales.createvue', compact('insert','alertant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alertants $alertants)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alertants $alertants)
    {
        //
    }
}
