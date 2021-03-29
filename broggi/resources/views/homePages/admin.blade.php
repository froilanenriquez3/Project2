@extends('templates.landingpage')
@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/homePages/admin.css?' . rand()) }}">
@endsection
@section('title', 'Administrador')
{{-- Navbar admin --}}
@section('navbar')
@include('partials.navbarAdmin')
@endsection
@section('content')
    <section id="menuSection">
        <a href="{{ asset('/alertants') }}">
            <div>
                <p>Alertantes habituales</p>
            </div>
        </a>
        <a href="{{ asset('/recursos') }}">
            <div>
                <p>Recursos móviles</p>
            </div>
        </a>
        <a href="{{ asset('/usuaris') }}">
            <div>
                <p>Usuarios</p>
            </div>
        </a>
        <div>
            <p>Incidencias</p>
        </div>
    </section>

@endsection
