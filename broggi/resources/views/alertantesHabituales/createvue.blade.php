@extends('templates.create')
@section('links')
    <link rel="stylesheet" href=" {{ url('../resources/css/alertants/alertantsCreate.css?'.rand()) }}">
@endsection
@section('title','Alertantes Habituales Formulario')

{{-- Add if for admin navbar --}}
{{-- Navbar teleoperador --}}
@section('navbar')
@include('partials.navbarTeleoperador')
@endsection

@section('form')

<h5 id="formTitle">Alertants</h5>

<alertants></alertants>

@endsection
