@extends('templates.navbar')

@section('navbarLinks')
<!--Inicio-->
<li class="nav-inicio  mr-2 ">
    <a class="nav-link navbarLinks" href=" {{ url('/ahome')}}"><i class="fas fa-home"></i> Inicio </a>
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
    <a class="nav-link navbarLinks" href="#"><i class="fas fa-ambulance"></i> Recursos móviles </a>
</li>
<!--Usuarios-->
<li class="nav-recursos mr-2">
    <a class="nav-link navbarLinks" href="#"><i class="fas fa-users-cog"></i> Usuarios</a>
</li>


@endsection
