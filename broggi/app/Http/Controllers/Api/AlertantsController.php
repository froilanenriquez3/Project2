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
        $alertants= new Alertants();

        $alertants->telefon= $request->input('telefon');
        $alertants->nom= $request->input('nom');
        $alertants->cognoms= $request->input('cognoms');
        $alertants->adreca= $request->input('adreca');
        $alertants->municipis_id= $request->input('municipis_id');
        $alertants->tipus_alertants_id= $request->input('tipus_alertants_id');

        try{
        $alertants->save();
        $response= (new AlertantsResource($alertants))
                    ->response()
                    ->setStatusCode(201);
                    //->json(['message' => 'Alertant creat correctament'], 201);

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
     * @param  \App\Models\Alertants  $alertant
     * @return \Illuminate\Http\Response
     */
    public function show(Alertants $alertant)
    {
        $alertant = Alertants::with(['municipis','tipus_alertants'])->find($alertant->id);

        return new AlertantsResource($alertant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alertants $alertant)
    {

        $alertant->telefon= $request->input('telefon');
        $alertant->nom= $request->input('nom');
        $alertant->cognoms= $request->input('cognoms');
        $alertant->adreca= $request->input('adreca');
        $alertant->municipis_id= $request->input('municipis_id');
        $alertant->tipus_alertants_id= $request->input('tipus_alertants_id');

        try{
        $alertant->save();
        $response= (new alertantsResource($alertant))
                    ->response()
                    ->setStatusCode(201);
                    //->json(['message' => 'Alertant actualitzat correctament'], 201);
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
     * @param  \App\Models\Alertants  $alertants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alertants $alertant)
    {
        try{
            $alertant->delete();
            $response= \response()
                        ->json(['message'=>'Alertant esborrat correctament'], 200);
        } catch (QueryException $ex){
            $message = Utilitat::errorMessage($ex);
            $response= \response()
                        ->json(['error'=> $message], 400);
        }

            return $response;
    }
}
