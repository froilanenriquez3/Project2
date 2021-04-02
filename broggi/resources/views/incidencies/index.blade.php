@extends('templates.index')
@section('title','Incidencies')

@section('links')
 @include('partials.mapLinks')
 <link rel="stylesheet" href=" {{ asset('../resources/css/incidencies/create.css?'.rand()) }}">
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

