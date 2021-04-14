@extends('templates.create')

@section('title','Incidencia Recursos Formulario')

@section('links')
<link rel="stylesheet" href="{{ asset('../resources/css/incidenciesRecursos/incidenciesRecursos.css?'.rand())}}">
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
@endsection

@section('form')
    <incidencies-recursos :userrecursoid='{{ $recursosId }}'></incidencies-recursos>
@endsection
