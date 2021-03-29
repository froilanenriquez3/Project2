@extends('templates.create')
@section('links')
    <link rel="stylesheet" href=" {{ url('../resources/css/alertants/alertantsCreate.css?'.rand()) }}">
@endsection
@section('title','Alertantes Habituales Formulario')

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

@section('form')

<h5 id="formTitle">Alertants</h5>

<alertants></alertants>

@endsection
