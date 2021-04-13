<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Incidencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Resources\IncidenciesResource;
use App\Models\IncidenciesHasRecursos;

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

        DB::beginTransaction();
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

        // Campo de la ternaria
        // $infoRecursos = [];
        $infoRecursos = $request->input('infoRecursos');


        // $incidencia->telefon_alertant = '';

        $userId = Auth::user();

        $incidencia->usuaris_id  = $userId->id;

        try{
            $incidencia->save();

            foreach ($infoRecursos as $infoRecurs) {
                $ihr= new IncidenciesHasRecursos();
                // $ihr->incidencies_id= $incidencia->id;
                $ihr->data = $infoRecurs['recursos_id'];
                $ihr->data = $infoRecurs['hora_activacio'];
                $ihr->data = $infoRecurs['hora_movilitzacio'];
                $ihr->data = $infoRecurs['hora_assistencia'];
                $ihr->data = $infoRecurs['hora_transport'];
                $ihr->data = $infoRecurs['hora_arribada_hospital'];
                $ihr->data = $infoRecurs['hora_transferencia'];
                $ihr->data = $infoRecurs['hora_finalitzacio'];
                $ihr->data = $infoRecurs['prioritat'];
                $ihr->data = $infoRecurs['desti'];
                $ihr->data = $infoRecurs['afectat_id'];

                $incidencia->incidencies_has_recursos()->save($ihr);

            }

            DB::commit();
            $incidencia->refresh();

            $response = (new IncidenciesResource($incidencia))
                    ->response()
                    ->setStatusCode(201);
        } catch (QueryException $ex) {
            DB::rollBack();
            $message = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $message], 400);

        }



        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencies  $incidency
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencies $incidency)
    {

           $incidency= Incidencies::with(['incidencies_has_recursos.recursos', 'incidencies_has_recursos.afectats'])->find($incidency->id);

            return new IncidenciesResource($incidency);

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
