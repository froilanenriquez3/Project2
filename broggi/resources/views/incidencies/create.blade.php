@extends('templates.create')

@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/homePages/teleoperador.css?' . rand()) }}">
@endsection

@section('title', 'Formulario de incidencias')

{{-- Navbar teleoperador --}}
@section('navbar')
@include('partials.navbarTeleoperador')
@endsection
@section('content')

<p>I am incidencies form</p>

@endsection

