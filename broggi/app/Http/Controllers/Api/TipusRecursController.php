<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use Illuminate\Http\Request;
use App\Models\Tipus_recursos;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
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
        $tipus= new Tipus_recursos();

        $tipus->tipus= $request->input('tipus');

        try{
            $tipus->save();
            $response= (new TipusRecursosResource($tipus))
                        ->response()
                        ->setStatusCode(201);
                        // ->json(['message' => 'Tipus de Recurs creat correctament'], 201);
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
     * @param  \App\Models\Tipus_recursos  $tipusrecurso
     * @return \Illuminate\Http\Response
     */
    public function show(Tipus_recursos $tipusrecurso)
    {
        $tipus = Tipus_recursos::find($tipusrecurso->id);
        return new TipusRecursosResource($tipus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipus_recursos  $tipusrecurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipus_recursos $tipusrecurso)
    {
        $tipusrecurso->tipus= $request->input('tipus');

        try{
            $tipusrecurso->save();
            $response= (new tipusRecursosResource($tipusrecurso))
                        ->response()
                       ->setStatusCode(201);
                        // ->json(['message' => 'Tipus de Recurs guardat correctament'], 201);
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
     * @param  \App\Models\Tipus_recursos  $tipusrecurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipus_recursos $tipusrecurso)
    {
        try{
            $tipusrecurso->delete();
            $response= \response()
                        ->json(['message'=>'Tipus de Recurs esborrat correctament'], 200);
        } catch (QueryException $ex){
            $message = Utilitat::errorMessage($ex);
            $response= \response()
                        ->json(['error'=> $message], 400);
        }

            return $response;
    }
}
