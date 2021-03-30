@extends('templates.navbar')

@section('navbarLinks')
<!--Inicio-->
<li class="nav-inicio  mr-2 ">
    <a class="nav-link navbarLinks" href=" {{ url('/thome')}}"><i class="fas fa-home"></i> Teleoperador Inicio </a>
</li>

 <!--Nueva incidencias-->
 <li class="nav-incidencias mr-2">
    <a class="nav-link navbarLinks" style=":hover {color: yellow}" href=" "><i class="fas fa-plus-circle"></i> Nueva incidencia </a>
</li>
<!--Incidencias-->
<li class="nav-usuaris mr-2">
    <a class="nav-link navbarLinks" href="#"><i class="fas fa-exclamation-triangle"></i> Incidencias </a>
</li>
<!--Alertantes habituales-->
<li class="nav-habituales mr-2">
    <a class="nav-link navbarLinks" href=" {{ url('/alertants')}}"><i class="fas fa-users"></i> Alertantes habituales </a>
</li>
<!--Recursos móviles-->
<li class="nav-recursos mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/alertants')}}"><i class="fas fa-ambulance"></i> Recursos móviles </a>
</li>


@endsection
