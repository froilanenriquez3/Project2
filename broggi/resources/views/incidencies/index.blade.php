@extends('templates/index')

@section('links')
{{-- <link rel="stylesheet" href="{{ asset('../resources/css/incidenciesRecursos/incidenciesRecursos.css?' . rand()) }}"> --}}
@endsection

@section('navbar')
{{-- Add if for admin navbar --}}
@if(Auth::user()->rols_id == 1)
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@elseif(Auth::user()->rols_id == 2)
{{-- Navbar teleoperador --}}
    @include('partials.navbarTeleoperador')
@endif

@section('title','Incidencies')

@section('table')


@endsection

@section('addButton')
    {{-- <a href="{{ url('/alertants/create') }}"> <button class="btn btn-primary" id="addButton">Afegir</button></a> --}}
@endsection
