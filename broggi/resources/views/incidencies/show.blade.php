@extends('templates.create')
@section('title', 'Incidencia')

@section('links')

    <link href="{{ url('https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css') }}" rel='stylesheet' />
    <script src="{{ url('https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js') }}"></script>
    <link href="{{ url('https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href=" {{ asset('../resources/css/incidencies/create.css?' . rand()) }}">
    <link rel="stylesheet" href=" {{ asset('../resources/css/incidencies/recursos.css?' . rand()) }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/videoComponent.css?' . rand()) }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/incidencies/show.css?' . rand()) }}">
@endsection

{{-- Navbar teleoperador --}}
@section('navbar')
    {{-- Add if for admin navbar --}}
    @if (Auth::user()->rols_id == 1)
        {{-- Navbar admin --}}
        @include('partials.navbarAdmin')
    @elseif(Auth::user()->rols_id == 2)
        {{-- Navbar teleoperador --}}
        @include('partials.navbarTeleoperador')
    @endif
@endsection

@section('form')

    <incidencies-show :showincidencia="{{ $incidencia }}"></incidencies-show>

@endsection
