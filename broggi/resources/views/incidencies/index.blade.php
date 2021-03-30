@extends('templates.index')
@section('title','Incidencies')

{{-- Navbar teleoperador --}}
@section('navbar')
@include('partials.navbarTeleoperador')
@endsection

@section('table')
<p>I am incidencies index</p>
{{-- Filters (changing depending on type of user) --}}

{{-- Table
    Campos para mostrar (erase me):
    Numero(id)
    Calle
    Descripcion (shortened)
    Municipio
    Numero telefono de alertante
    --}}

@endsection

