@extends('templates.index')
@section('title','Incidencies')

@section('links')
 <link rel="stylesheet" href=" {{ asset('../resources/css/incidencies/create.css?'.rand()) }}">
 <link href="{{ url('https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css')}}" rel='stylesheet' />
 <script src="{{ url('https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js')}}"></script>
<link href="{{ url('https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css')}}" rel="stylesheet"/>
@endsection
{{-- Navbar teleoperador --}}
@section('navbar')
@include('partials.navbarTeleoperador')
@endsection

@section('table')
<mapa-incidencies></mapa-incidencies>

{{-- Table
    Campos para mostrar (erase me):
    Numero(id)
    Calle
    Descripcion (shortened)
    Municipio
    Numero telefono de alertante
    --}}

@endsection

