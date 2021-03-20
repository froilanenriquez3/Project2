<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuaris;
use App\Clases\Utilitat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarisResource;
use Illuminate\Database\QueryException;

class UsuarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuaris= Usuaris::all();

        return UsuarisResource::collection($usuaris);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuari= new Usuaris();

        $usuari->username= $request->input('username');
        $usuari->contrasenya= $request->input('constrasenya');
        $usuari->nom= $request->input('nom');
        $usuari->cognom= $request->input('cognom');
        $usuari->rols_id= $request->input('rols_id');
        $usuari->recursos_id= $request->input('recursos_id');

        try{
        $usuari->save();
        $response= (new UsuarisResource($usuari))
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
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function show(Usuaris $usuaris)
    {
        $usuaris = Usuaris::with('rols')->find($usuaris->rols_id)
                        ->with('recurs')->find($usuaris->recursos_id);
        return new UsuarisResource($usuaris);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuaris $usuaris)
    {

        $usuaris->username= $request->input('username');
        $usuaris->contrasenya= $request->input('constrasenya');
        $usuaris->nom= $request->input('nom');
        $usuaris->cognom= $request->input('cognom');
        $usuaris->rols_id= $request->input('rols_id');
        $usuaris->recursos_id= $request->input('recursos_id');

        try{
        $usuaris->save();
        $response= (new UsuarisResource($usuaris))
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
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuaris $usuaris)
    {
        try{
            $usuaris->delete();
            $response= \response()
                        ->json(['message'=>'registro borrado correcto'], 200);
        } catch (QueryException $ex){
            $message = Utilitat::errorMessage($ex);
            $response= \response()
                        ->json(['error'=> $message], 400);
        }

            return $response;
        }
}
