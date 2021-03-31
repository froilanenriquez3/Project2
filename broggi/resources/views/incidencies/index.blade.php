@extends('templates.index')
@section('title','Incidencies')

{{-- Navbar teleoperador --}}
@section('navbar')
@include('partials.navbarTeleoperador')
@endsection

@section('table')
<p>I am incidencies index</p>

{{-- Table
    Campos para mostrar (erase me):
    Numero(id)
    Calle
    Descripcion (shortened)
    Municipio
    Numero telefono de alertante
    --}}

@endsection

