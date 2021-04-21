@extends('templates.navbar')

@section('navbarLinks')
<!--Inicio-->
<li class="nav-inicio  mr-2 ">
    <a class="nav-link navbarLinks" href=" {{ url('/rhome')}}"><i class="fas fa-home"></i> Recursos Inici </a>
</li>

<!--Incidencia actual-->
<li class="nav-usuaris mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/incidenciesrecursos/create')}}"><i class="fas fa-exclamation-triangle"></i> Incidència actual </a>
</li>
<!--Ver historial-->
<li class="nav-habituales mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/incidenciesrecursos')}}"><i class="fas fa-file-medical"></i> Veure historial </a>
</li>



@endsection
