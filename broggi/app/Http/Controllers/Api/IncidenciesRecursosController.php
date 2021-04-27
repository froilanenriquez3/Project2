<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Recursos;
use App\Models\Incidencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\RecursosResource;
use App\Http\Resources\IncidenciesResource;

class IncidenciesRecursosController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recursos  $recurso
     * @return \Illuminate\Http\Response
     */
    public function show(Recursos $recurso)
    {
        $recurso = Recursos::with(['incidencies_has_recursos.incidencies', 'incidencies_has_recursos.afectats', 'tipus_recursos'])->find($recurso->id);
        return new RecursosResource($recurso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencies  $incidenciesrecurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencies $incidenciesrecurso)
    {
       /*  DB::beginTransaction();
        $array = $request->input('incidencies_has_recursos');
        try{
            $ihr = $array[0];
            $incidencies->incidencies_has_recursos()->save($ihr);
            DB::commit();
            $incidencies->refresh();

            $response = (new IncidenciesResource($incidencies))
                    ->response()
                    ->setStatusCode(201);
        } catch (QueryException $ex) {
            DB::rollBack();
            $message = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $message], 400);

        }
        return $response; */

        DB::beginTransaction();

        $infoRecursos = $request->input('incidencies_has_recursos');

        try {

            if (!is_null($infoRecursos)) {
                foreach ($infoRecursos as $infoRecurs) {

                    if ($request->input('saveRecurs') == $infoRecurs['recursos_id']) {

                        $incidenciesrecurso->incidencies_has_recursos()
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
                                    'afectat_id'            => $infoRecurs['afectat_id'],
                                ]
                            );
                    }

                    // $incidenciesrecurso->incidencies_has_recursos()->save($ihr);
                }
            }

            DB::commit();
            $incidenciesrecurso->refresh();

            $response = (new IncidenciesResource($incidenciesrecurso))
                ->response()
                ->setStatusCode(201);
                //->json(['message' => 'Incidencia actualitzada correctament'], 201);

            // $request->session()->flash('message', "Incidencia afegida correctament");
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
     * @param  \App\Models\Incidencies  $incidenciesrecurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencies $incidenciesrecurso)
    {
        DB::beginTransaction();

        try {
            $incidenciesrecurso->incidencies_has_recursos()->delete();

            DB::commit();
            $incidenciesrecurso->refresh();

            $response = \response()
                ->json(['message' => 'Incidencia esborrada correctament'], 200);
        } catch (QueryException $ex) {
            DB::rollBack();
            $message = Utilitat::errorMessage($ex);
            $response = \response()
                ->json(['error' => $message], 400);
        }

        return $response;
    }
}
