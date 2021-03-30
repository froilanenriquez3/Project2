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
        $alertants= Tipus_alertants::all();

        return TipusAlertantsResource::collection($alertants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipus_alertants  $tipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Tipus_alertants $tipo)
    {
        $tipo->tipus= $request->input('tipus');

        try{
            $tipo->save();
            $response= (new TipusAlertantsResource($tipo))
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
     * Remove the specified resource from storage.
     *
    * @param  \App\Models\Tipus_alertants  $tipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipus_alertants $tipo)
    {
        try{
            $tipo->delete();
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
