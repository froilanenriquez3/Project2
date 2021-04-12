@extends('templates.navbar')

@section('navbarLinks')
<!--Inicio-->
<li class="nav-inicio  mr-2 ">
    <a class="nav-link navbarLinks" href=" {{ url('/rhome')}}"><i class="fas fa-home"></i> Recursos Inicio </a>
</li>

<!--Incidencia actual-->
<li class="nav-usuaris mr-2">
    <a class="nav-link navbarLinks" href="{{ url('/incidenciesrecursos')}}"><i class="fas fa-exclamation-triangle"></i> Incidencia actual </a>
</li>
<!--Ver historial-->
<li class="nav-habituales mr-2">
    <a class="nav-link navbarLinks" href="#"><i class="fas fa-file-medical"></i> Ver historial </a>
</li>



@endsection
