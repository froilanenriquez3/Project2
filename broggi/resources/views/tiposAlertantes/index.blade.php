@extends('templates/indexSideBar')

@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/alertants/alertantsIndex.css?' . rand()) }}">
@endsection

@section('navbar')
    {{-- Add if for admin navbar --}}
    @if (Auth::user()->rols_id == 1)
        {{-- Navbar admin --}}
        @include('partials.navbarAdmin')
    @elseif(Auth::user()->rols_id == 2)
        {{-- Navbar teleoperador --}}
        @include('partials.navbarTeleoperador')
    @endif

@section('title', "Tipus d'alertants")

@section('sidebar')
    @include('partials.alSideBar')
@endsection

@section('table')

    <tipus-alertants></tipus-alertants>

@endsection

@section('addButton')
    {{-- <a href=""> <button class="btn btn-primary" id="addButton" onclick="selectAction('afegir')">Afegir</button></a> --}}
@endsection
