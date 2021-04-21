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
                <i class="icon fas fa-users  d-flex justify-content-center pb-3"></i>
                <p>Alertants habituals</p>
            </div>
        </a>
        <a href="{{ asset('/recursos') }}">
            <div>
                <i class="icon fas fa-ambulance  d-flex justify-content-center pb-3"></i>
                <p>Recursos mòbils</p>
            </div>
        </a>
        <a href="{{ asset('/usuaris') }}">
            <div>
                <i class="icon fas fa-users-cog  d-flex justify-content-center pb-3"></i>
                <p>Usuaris</p>
            </div>
        </a>
        <a href="{{ url('/incidencies') }}">
            <div>
                <i class="icon fas fa-exclamation-triangle  d-flex justify-content-center pb-3"></i>
                <p>Incidències</p>
            </div>
        </a>
    </section>

@endsection
