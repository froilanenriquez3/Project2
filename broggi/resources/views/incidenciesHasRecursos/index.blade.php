@extends('templates/index')

@section('links')
<link rel="stylesheet" href="{{ asset('../resources/css/alertants/alertantsIndex.css?' . rand()) }}">
@endsection

@section('navbar')
{{-- Add if for admin navbar --}}
@if(Auth::user()->rols_id == 1)
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@elseif(Auth::user()->rols_id == 3)
{{-- Navbar teleoperador --}}
    @include('partials.navbarRecursos')
@endif

@section('title','Historial de incidencies')

@section('table')

<increc-table></increc-table>

@endsection

@section('addButton')
    {{-- <a href="{{ url('/alertants/create') }}"> <button class="btn btn-primary" id="addButton">Afegir</button></a> --}}
@endsection
