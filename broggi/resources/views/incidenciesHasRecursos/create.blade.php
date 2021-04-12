@extends('templates.create')

@section('title','Incidencia Recursos Formulario')

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

@endsection
