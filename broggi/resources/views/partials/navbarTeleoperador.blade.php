@extends('templates.navbar')

@section('navbarLinks')
<!--Inicio-->
<li class="nav-inicio  mr-2 ">
    <a class="nav-link navbarLinks" href=" {{ url('/thome')}}"><i class="fas fa-home"></i> Teleoperador Inici </a>
</li>

 <!--Nueva incidencias-->
 <li class="nav-incidencias mr-2">
    <a class="nav-link navbarLinks" style=":hover {color: yellow}" href="{{ url('/incidencies/create') }}"><i class="fas fa-plus-circle"></i> Nova incidència </a>
</li>
<!--Incidencias-->
<li class="nav-usuaris mr-2">
    <a class="nav-link navbarLinks" href=" {{ url('/incidencies') }}"><i class="fas fa-exclamation-triangle"></i> Incidències </a>
</li>
<!--Alertantes habituales-->
<li class="nav-habituales mr-2">
    <a class="nav-link navbarLinks" href=" {{ url('/alertants')}}"><i class="fas fa-users"></i> Alertants habituals </a>
</li>
<!--Recursos móviles-->
<li class="nav-recursos mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/recursos')}}"><i class="fas fa-ambulance"></i> Recursos mòbils </a>
</li>


@endsection
