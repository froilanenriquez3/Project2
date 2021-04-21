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
                <i class="icon fas fa-exclamation-triangle  d-flex justify-content-center pb-3"></i>
                <p>Incidència actual</p>
            </div>
        </a>
        <a href="{{ url('/incidenciesrecursos') }}">
            <div>
                <i class="icon fas fa-file-medical  d-flex justify-content-center pb-3"></i>
                <p>Veure historial</p>
            </div>
        </a>

    </section>

@endsection
