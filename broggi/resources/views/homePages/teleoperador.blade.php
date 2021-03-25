@extends('templates.landingPage')
@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/homePages/teleoperador.css?' . rand()) }}">
@endsection
@section('title','Teleoperador')
@section('content')
    <section id="menuSection">
        <div>
            <p>Formulario, nueva indidencia</p>
        </div>
        <div>
            <p>Gestionar alertantes habituales</p>
        </div>
        <div>
            <p>Incidencias</p>
        </div>
        <div>
            <p>Recursos Moviles</p>
        </div>
    </section>
@endsection
