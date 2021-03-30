@extends('templates.landingPage')
@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/homePages/teleoperador.css?' . rand()) }}">
@endsection
@section('title','Teleoperador')

{{-- Navbar teleoperador --}}
@section('navbar')
@include('partials.navbarTeleoperador')
@endsection

@section('content')
    <section id="menuSection">
        <div id="incidencias">
            <p>Formulario, nueva incidencia</p>
            <div>
                <a href="">Modo normal</a>
                <p> | </p>
                <a href="">Modo formacion</a>
            </div>

        </div>
        <a href="{{ asset('/alertants') }}">
            <div>
                <p>Alertantes habituales</p>
            </div>
        </a>
        <div>
            <p>Incidencias</p>
        </div>
        <a href="{{ asset('/recursos') }}">
            <div>
                <p>Recursos móviles</p>
            </div>
        </a>
    </section>
@endsection
