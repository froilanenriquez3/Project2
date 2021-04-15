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
                <i class="icon fas fa-plus-circle  d-flex justify-content-center pb-3"></i>
                <p>Nueva Incidencia</p>
            </div>
        </a>
        <a href="{{ asset('/alertants') }}">
            <div>
                <i class="icon fas fa-users  d-flex justify-content-center pb-3"></i>
                <p>Alertantes habituales</p>
            </div>
        </a>
        <a href="{{ asset('/incidencies') }}">
            <div>
                <i class="icon fas fa-exclamation-triangle  d-flex justify-content-center pb-3"></i>
                <p>Ver incidencias</p>
            </div>
        </a>
        <a href="{{ asset('/recursos') }}">
            <div>
                <i class="icon fas fa-ambulance  d-flex justify-content-center pb-3"></i>
                <p>Recursos móviles</p>
            </div>
        </a>
    </section>
@endsection
