<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Recursos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\RecursosResource;

class RecursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recursos= Recursos::all();

        return RecursosResource::collection($recursos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recursos= new Recursos();

        $recursos->codi= $request->input('codi');
        $recursos->actiu = ($request->input('actiu') == 1);
        $recursos->tipus_recursos_id= $request->input('tipus_recursos_id');
        $recursos->lat= $request->input('lat');
        $recursos->lon= $request->input('lon');

        try{
            $recursos->save();
            $response= (new RecursosResource($recursos))
                        ->response()
                        //->setStatusCode(201);
                        ->json(['message' => 'Recurs creat correctament'], 201);
            } catch (QueryException $ex){
                $message = Utilitat::errorMessage($ex);
                $response = \response()
                            ->json(['error'=> $message], 400);
            }

            return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recursos  $recurso
     * @return \Illuminate\Http\Response
     */
    public function show(Recursos $recurso)
    {
        // $recurso = Recursos::with('tipus_recursos')->find($recurso->id);
        $recurso = Recursos::with(['incidencies_has_recursos.incidencies', /* 'incidencies_has_recursos.afectats', */ 'tipus_recursos'])->find($recurso->id);
        return new RecursosResource($recurso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recursos  $recurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recursos $recurso)
    {

        $recurso->codi= $request->input('codi');
        $recurso->actiu = ($request->input('actiu') == 1);
        $recurso->tipus_recursos_id= $request->input('tipus_recursos_id');
        $recurso->lat= $request->input('lat');
        $recurso->lon= $request->input('lon');

        try{
            $recurso->save();
            $response= (new RecursosResource($recurso))
                        ->response()
                        ->setStatusCode(201);
                        // ->json(['message' => 'Recurs actualitzat correctament'], 201);
            } catch (QueryException $ex){
                $message = Utilitat::errorMessage($ex);
                $response = \response()
                            ->json(['error'=> $message], 400);
            }

            return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recursos  $recurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recursos $recurso)
    {
        try{
            $recurso->delete();
            $response= \response()
                        ->json(['message'=>'Recurs esborrat correctament'], 200);
        } catch (QueryException $ex){
            $message = Utilitat::errorMessage($ex);
            $response= \response()
                        ->json(['error'=> $message], 400);
        }

            return $response;
    }
}
