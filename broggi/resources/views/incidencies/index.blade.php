@extends('templates.components')
@section('title','Incidencies')

@section('links')

 <link href="{{ url('https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css')}}" rel='stylesheet' />
 <script src="{{ url('https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js')}}"></script>
<link href="{{ url('https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href=" {{ asset('../resources/css/incidencies/create.css?'.rand()) }}">
<link rel="stylesheet" href="{{ asset('../resources/css/videoComponent.css?'.rand()) }}">
@endsection

{{-- Navbar teleoperador --}}
@section('navbar')
{{-- Add if for admin navbar --}}
@if(Auth::user()->rols_id == 1)
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@elseif(Auth::user()->rols_id == 2)
{{-- Navbar teleoperador --}}
    @include('partials.navbarTeleoperador')
@endif
@endsection

@section('table')
<container-incidencies></container-incidencies>

{{-- Table
    Campos para mostrar (erase me):
    Numero(id)
    Calle
    Descripcion (shortened)
    Municipio
    Numero telefono de alertante
    --}}

@endsection

