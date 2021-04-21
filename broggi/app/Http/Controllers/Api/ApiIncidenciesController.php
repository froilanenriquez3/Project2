<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Afectats;
use App\Models\Incidencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\IncidenciesHasRecursos;
use Illuminate\Database\QueryException;
use App\Http\Resources\AfectatsResource;
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
        $incidencies = Incidencies::all();

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
        $afectats = $request->input('afectats');
        $infoRecursos = $request->input('infoRecursos');

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

        // Campo de la ternaria
        // $infoRecursos = [];

        // $incidencia->telefon_alertant = '';

        $userId = Auth::user();

        $incidencia->usuaris_id  = $userId->id;

        // $incidencia->usuaris_id  = 1;

        try {
            $incidencia->save();

            foreach ($afectats as $afectat) {
                $afectatStore = new Afectats();

                $positionArray = $afectat['id'];
                $afectatStore->telefon = $afectat['telefon'];
                $afectatStore->cip = $afectat['cip'];
                $afectatStore->nom = $afectat['nom'];
                $afectatStore->cognoms = $afectat['cognoms'];
                $afectatStore->edat = $afectat['edat'];
                $afectatStore->sexes_id = $afectat['sexes_id'];

                $afectatStore->save();

                $afectatNewId = $afectatStore->id;

                $infoRecursos[$positionArray]['afectat_id'] = $afectatNewId;

                $incidencia->incidencies_has_afectats()->save($afectatStore);
            }

            foreach ($infoRecursos as $infoRecurs) {
                $ihr = new IncidenciesHasRecursos();
                // $ihr->incidencies_id= $incidencia->id;
                $ihr->recursos_id = $infoRecurs['recursos_id'];
                $ihr->hora_activacio = $infoRecurs['hora_activacio'];
                $ihr->hora_mobilitzacio = $infoRecurs['hora_mobilitzacio'];
                $ihr->hora_assistencia = $infoRecurs['hora_assistencia'];
                $ihr->hora_transport = $infoRecurs['hora_transport'];
                $ihr->hora_arribada_hospital = $infoRecurs['hora_arribada_hospital'];
                $ihr->hora_transferencia = $infoRecurs['hora_transferencia'];
                $ihr->hora_finalitzacio = $infoRecurs['hora_finalitzacio'];
                $ihr->prioritat = $infoRecurs['prioritat'];
                $ihr->desti = $infoRecurs['desti'];
                $ihr->afectat_id = $infoRecurs['afectat_id'];
                $ihr->prioritat = $infoRecurs['prioritat'];

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

        $incidency = Incidencies::with(['incidencies_has_recursos.recursos', 'incidencies_has_recursos.afectats'])->find($incidency->id);

        return new IncidenciesResource($incidency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencies  $incidency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencies $incidency)
    {
        DB::beginTransaction();

        // $incidency = Incidencies::find($request->input('id'));
        // $incidencies->id = $request->input('id');
        $incidency->hora                 = $request->input('hora');
        $incidency->telefon_alertant     = $request->input('telefon_alertant');
        $incidency->data                 = $request->input('data');
        $incidency->adreca               = $request->input('adreca');
        $incidency->adreca_complement    = $request->input('adreca_complement');
        $incidency->descripcio           = $request->input('descripcio');
        $incidency->nom_metge            = $request->input('nom_metge');
        $incidency->tipus_incidencies_id = $request->input('tipus_incidencies_id');
        $incidency->alertants_id         = $request->input('alertants_id');
        $incidency->municipis_id         = $request->input('municipis_id');
        $incidency->duracion             = $request->input('duracion');

        // Campo de la ternaria
        // $infoRecursos = [];
        // $incidencia->telefon_alertant = '';

        $userId = Auth::user();
        $incidency->usuaris_id  = $userId->id;
        // $incidency->usuaris_id  = 1;

        $infoRecursos = $request->input('incidencies_has_recursos');

        try {
            $incidency->save();
            if (!is_null($infoRecursos)) {
                foreach ($infoRecursos as $infoRecurs) {

                    if ($request->input('saveRecurs') == $infoRecurs['recursos_id']) {

                        $incidency->incidencies_has_recursos()
                            ->where('recursos_id', $infoRecurs['recursos_id'])
                            ->update(
                                [
                                    // 'recursos_id' => $infoRecurs['recursos_id'],
                                    'hora_activacio'        => $infoRecurs['hora_activacio'],
                                    'hora_mobilitzacio'     => $infoRecurs['hora_mobilitzacio'],
                                    'hora_assistencia'      => $infoRecurs['hora_assistencia'],
                                    'hora_transport'        => $infoRecurs['hora_transport'],
                                    'hora_arribada_hospital'=> $infoRecurs['hora_arribada_hospital'],
                                    'hora_transferencia'    => $infoRecurs['hora_transferencia'],
                                    'hora_finalitzacio'     => $infoRecurs['hora_finalitzacio'],
                                    'prioritat'             => $infoRecurs['prioritat'],
                                    'desti'                 => $infoRecurs['desti'],
                                    // 'afectat_id'            => $infoRecurs['afectat_id'],
                                ]
                            );
                    }

                    // $incidency->incidencies_has_recursos()->save($ihr);
                }
            }


            DB::commit();
            $incidency->refresh();

            $response = (new IncidenciesResource($incidency))
                ->response()
                ->setStatusCode(201);

            $request->session()->flash('message', "Incidencia afegida correctament");
        } catch (QueryException $ex) {
            DB::rollBack();
            $message = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $message], 400);
        }



        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencies  $incidency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencies $incidency)
    {
        DB::beginTransaction();

        try {
            $incidency->incidencies_has_recursos()->delete();

            $incidency->incidencies_has_afectats()->detach();
            $incidency->incidencies_has_afectats()->delete();

            $incidency->delete();

            DB::commit();
            $incidency->refresh();

            $response = \response()
                ->json(['message' => 'Incidencia borrado correctamente'], 200);
        } catch (QueryException $ex) {
            DB::rollBack();
            $message = Utilitat::errorMessage($ex);
            $response = \response()
                ->json(['error' => $message], 400);
        }

        return $response;
    }
}
