<?php

namespace App\Http\Controllers;

use App\Models\Usuaris;
use App\Clases\Utilitat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UsuarisController extends Controller
{

    public function logout(){
        Auth::logout();
        return view('login');
    }

    public function login(Request $request)
    {
        $route = view('login');
        $username = $request->input('username');

        $user = Usuaris::where('username', $username)->get()->first();
        if (!empty($user)) {
            $password = $request->input('contrasenya');
            if (Hash::check($password, $user->contrasenya)) {
                Auth::login($user);

                //print_r(Auth::user());

                $userRol = $user->rols_id;
                switch ($userRol) {
                    case 1:
                        $route = view('homePages.admin');
                        break;
                    case 2:
                        $route = view('homePages.teleoperador');
                        break;
                    case 3:
                        $route = view('homePages.recurs');
                        break;
                }
            } else {
                $request->session()->flash('error', 'Contrasenya incorrecta!');
            }
        } else {
            $request->session()->flash('error', "Nom d'usuari incorrecte!");
        }
        return $route;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function show(Usuaris  $usuaris)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuaris $usuaris)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuaris $usuaris)
    {
        //
    }
}
