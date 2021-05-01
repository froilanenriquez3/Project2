<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Afectats;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\AfectatsResource;

class AfectatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $afectats = Afectats::all();
        return AfectatsResource::collection($afectats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $afectats= new Afectats();

        $afectats->telefon= $request->input('telefon');
        $afectats->cip= $request->input('cip');
        $afectats->nom= $request->input('nom');
        $afectats->cognoms= $request->input('cognoms');
        $afectats->edat= $request->input('edat');
        $afectats->te_cip = ($request->input('te_cip') == 'te_cip');
        $afectats->sexes_id= $request->input('sexes_id');

        try{
        $afectats->save();
        $response= (new AfectatsResource($afectats))
                    ->response()
                    ->setStatusCode(201);
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
     * @param  \App\Models\Afectats  $afectat
     * @return \Illuminate\Http\Response
     */
    public function show(Afectats $afectat)
    {
        $afectat = Afectats::with(['municipis'])->find($afectat->id);

        return new AfectatsResource($afectat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Afectats  $afectats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afectats $afectats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Afectats  $afectats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Afectats $afectats)
    {
        //
    }
}
