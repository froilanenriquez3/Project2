@extends('templates.landingpage')
@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/homePages/recurs.css?' . rand()) }}">
@endsection
@section('title', 'Recursos móviles')
    {{-- Navbar recursos --}}
@section('navbar')
    @include('partials.navbarRecursos')
@endsection
@section('content')
    <section id="menuSection">
        <a href="{{ url('/incidenciesrecursos/create') }}">
            <div>
                <p>Incidencia actual</p>
            </div>
        </a>
        <a href="{{ url('/incidenciesrecursos') }}">
            <div>
                <p>Ver historial</p>
            </div>
        </a>

    </section>

@endsection
