@extends('templates.landingpage')
@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/homePages/recurs.css?' . rand()) }}">
@endsection
@section('title','Recursos móviles')
@section('content')
<section id="menuSection">
    <div >
        <p>Incidencia actual</p>
    </div>
    <div>
        <p>Ver historial</p>
    </div>

</section>

@endsection
