@extends('templates.landingpage')
@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/homePages/admin.css?' . rand()) }}">
@endsection
@section('title','Administrador')
@section('content')
<section id="menuSection">
    <div>
        <p>Alertantes habituales</p>
    </div>
    <div>
        <p>Recursos móviles</p>
    </div>
    <div>
        <p>Usuarios</p>
    </div>
    <div>
        <p>Incidencias</p>
    </div>
</section>

@endsection
