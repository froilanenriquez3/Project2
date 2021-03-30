<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuaris;
use App\Clases\Utilitat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $usuaris= new Usuaris();

        $usuaris->username= $request->input('username');
        $usuaris->contrasenya= bcrypt($request->input('contrasenya'));
        $usuaris->nom= $request->input('nom');
        $usuaris->cognoms= $request->input('cognoms');
        $usuaris->email= $request->input('email');
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
     * Display the specified resource.
     *
     * @param  \App\Models\Usuaris  $usuari
     * @return \Illuminate\Http\Response
     */
    public function show(Usuaris $usuari)
    {
        $usuari = Usuaris::with(['rols', 'recursos'])->find($usuari->id);

        return new UsuarisResource($usuari);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuaris  $usuari
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuaris $usuari)
    {
        $usuari->username= $request->input('username');
        $usuari->contrasenya= bcrypt($request->input('contrasenya'));
        $usuari->nom= $request->input('nom');
        $usuari->cognoms= $request->input('cognoms');
        $usuari->email= $request->input('email');
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuaris  $usuari
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuaris $usuari)
    {
        try{
            $usuari->delete();
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
