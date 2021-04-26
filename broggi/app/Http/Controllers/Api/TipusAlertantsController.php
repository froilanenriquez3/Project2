<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use Illuminate\Http\Request;
use App\Models\Tipus_alertants;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\TipusAlertantsResource;

class TipusAlertantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alertants = Tipus_alertants::all();

        return TipusAlertantsResource::collection($alertants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo= new Tipus_alertants();

        $tipo->tipus= $request->input('tipus');

        try{
            $tipo->save();
            $response= (new TipusAlertantsResource($tipo))
                        ->response()
                        //->setStatusCode(201);
                        ->json(['message' => 'Tipus d´Alertants creat correctament'], 201);
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
      * @param  \App\Models\Tipus_alertants  $tipusalertant
     * @return \Illuminate\Http\Response
     */
    public function show(Tipus_alertants $tipusalertant)
    {
        $recurso = Tipus_alertants::find($tipusalertant->id);
        return new TipusAlertantsResource($tipusalertant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipus_alertants  $tipusalertant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipus_alertants $tipusalertant)
    {
        $tipusalertant->tipus= $request->input('tipus');

        try{
            $tipusalertant->save();
            $response= (new TipusAlertantsResource($tipusalertant))
                        ->response()
                        //->setStatusCode(201);
                        ->json(['message' => 'Tipus d´Alertants guardat correctament'], 201);
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
    * @param  \App\Models\Tipus_alertants  $tipusalertant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipus_alertants $tipusalertant)
    {
        try{
            $tipusalertant->delete();
            $response= \response()
                        ->json(['message'=>'Tipus d´Alertants esborrat correctament'], 200);
        } catch (QueryException $ex){
            $message = Utilitat::errorMessage($ex);
            $response= \response()
                        ->json(['error'=> $message], 400);
        }

            return $response;
    }
}
