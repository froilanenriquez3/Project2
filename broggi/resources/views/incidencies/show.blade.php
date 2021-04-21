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

    <div class="row">
        <h5 class="col-4">Incidencia ID #{{ $incidencia->id }}</h5>
    </div>

    <div class="row">
        <p class="col-4"><b>Tipus Incidencia ID:</b> {{ $incidencia->tipus_incidencies_id }}</p>
        <p class="col-4"><b>Tipus Incidencia:</b> {{ $incidencia->tipus_incidencia }}</p>
    </div>

    <div class="row">
        <p class="col-4"><b>Descripcio:</b> {{ $incidencia->descripcio }}</p>
    </div>

    <div class="row">
        <p class="col-4"><b>Adreca:</b> {{ $incidencia->adreca }}</p>
        <p class="col-4"><b>Complement:</b> {{ $incidencia->adreca_complement }}</p>
        <p class="col-4"><b>Municipi:</b> {{ $incidencia->municipis->id }}</p>
    </div>


    <div class="row">
        <p class="col-4"><b>Hora:</b> {{ $incidencia->hora }}</p>
        <p class="col-4"><b>Data:</b> {{ $incidencia->data }}</p>

    </div>

    <div class="row">
        <p class="col-4"><b>Alertant ID:</b> {{ $incidencia->alertants_id }}</p>
        <p class="col-4"><b>Nom Metge:</b> {{ $incidencia->nom_metge }}</p>
        <p class="col-4"><b>Telefon Alertant:</b> {{ $incidencia->telefon_alertant }}</p>
    </div>

    <div class="row">
        <p class="col-6"><b>Usuaris ID:</b> {{ $incidencia->usuaris_id }}</p>
    </div>


@endsection
