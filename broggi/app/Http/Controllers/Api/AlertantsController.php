<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Alertants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\AlertantsResource;

class AlertantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alertants= Alertants::all();

        return AlertantsResource::collection($alertants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $alertants= new alertants();

        // $alertants->username= $request->input('username');
        // $alertants->contrasenya= $request->input('contrasenya');
        // $alertants->nom= $request->input('nom');
        // $alertants->cognoms= $request->input('cognoms');
        // $alertants->email= $request->input('email');
        // $alertants->rols_id= $request->input('rols_id');
        // $alertants->recursos_id= $request->input('recursos_id');

        // try{
        // $alertants->save();
        // $response= (new alertantsResource($alertants))
        //             ->response()
        //             ->setStatusCode(201);
        // } catch (QueryException $ex){
        //     $message = Utilitat::errorMessage($ex);
        //     $response = \response()
        //                 ->json(['error'=> $message], 400);
        // }

        // return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function show(Alertants $alertants)
    {
        //
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
        //
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
