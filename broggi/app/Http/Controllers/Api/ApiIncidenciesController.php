<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Incidencies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Resources\IncidenciesResource;

class ApiIncidenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidencies= Incidencies::all();

        return IncidenciesResource::collection($incidencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $incidencia = new Incidencies();

        $incidencia->data = $request->input('data');
        $incidencia->hora = $request->input('hora');
        $incidencia->telefon_alertant = $request->input('telefon_alertant');
        $incidencia->adreca = $request->input('adreca');
        $incidencia->adreca_complement = $request->input('adreca_complement');
        $incidencia->descripcio = $request->input('descripcio');
        $incidencia->nom_metge = $request->input('nom_metge');
        $incidencia->tipus_incidencies_id = $request->input('tipus_incidencies_id');
        $incidencia->alertants_id = $request->input('alertants_id');
        $incidencia->municipis_id = $request->input('municipis_id');

        $incidencia->duracion = $request->input('duracion');

        $incidencia->telefon_alertant = "123456789";

        $userId = Auth::user();

        $incidencia->usuaris_id  = $userId->id;

        try{
            $incidencia->save();
            $response = (new IncidenciesResource($incidencia))
                    ->response()
                    ->setStatusCode(201);
        } catch (QueryException $ex) {
            $message = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $message], 400);

        }



        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencies  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencies $incidencies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencies  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencies $incidencies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencies  $incidencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencies $incidencies)
    {
        try{
            $incidencies->delete();
            $response= \response()
                        ->json(['message'=>'Registro borrado correctamente'], 200);
        } catch (QueryException $ex){
            $message = Utilitat::errorMessage($ex);
            $response= \response()
                        ->json(['error'=> $message], 400);
        }

            return $response;
        }

}
