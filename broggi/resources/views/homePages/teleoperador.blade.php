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
        <a href="{{ url('/incidencies/create') }}">
            <div>
                <p>Nueva Incidencia</p>
            </div>
        </a>
        <a href="{{ asset('/alertants') }}">
            <div>
                <p>Alertantes habituales</p>
            </div>
        </a>
        <a href="{{ asset('/incidencies') }}">
            <div>
                <p>Ver incidencias</p>
            </div>
        </a>
        <a href="{{ asset('/recursos') }}">
            <div>
                <p>Recursos móviles</p>
            </div>
        </a>
    </section>
@endsection
