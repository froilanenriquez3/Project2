@extends('templates.navbar')

@section('navbarLinks')
<!--Inicio-->
<li class="nav-inicio  mr-2 ">
    <a class="nav-link navbarLinks" href="{{ url('/ahome')}}"><i class="fas fa-home"></i> Admin Inici </a>
</li>

<!--Incidencias-->
<li class="nav-usuaris mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/incidencies') }}"><i class="fas fa-exclamation-triangle"></i> Incidències </a>
</li>
<!--Alertantes habituales-->
<li class="nav-habituales mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/alertants')}}"><i class="fas fa-users"></i> Alertants habituals </a>
</li>
<!--Recursos móviles-->
<li class="nav-recursos mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/recursos')}}"><i class="fas fa-ambulance"></i> Recursos mòbils </a>
</li>
<!--Usuarios-->
<li class="nav-recursos mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/usuaris') }}"><i class="fas fa-users-cog"></i> Usuaris</a>
</li>


@endsection
