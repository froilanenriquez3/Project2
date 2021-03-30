@extends('templates/index')

@section('links')
<link rel="stylesheet" href="{{ asset('../resources/css/alertants/alertantsIndex.css?' . rand()) }}">
@endsection

@section('navbar')
{{-- Add if for admin navbar --}}
@if(Auth::user()->rols_id == 1)
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@elseif(Auth::user()->rols_id == 2)
{{-- Navbar teleoperador --}}
    @include('partials.navbarTeleoperador')
@endif

@section('title',"Tipus de recurs")

@section('table')

<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Tipus</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <th scope="row"></th>
        <td></td>
        <td>
            <form action="" method="GET">
            <button class="btn btn-primary" id="editAlertant" type="submit">Editar</button>
            </form>
        </td>
        <td>
            <button class="btn btn-danger" id="deleteAlertant" type="submit" onclick="">Esborrar</button>
        </td>
      </tr>

    </tbody>
  </table>

@endsection
@section('addButton')
    <a href=""> <button class="btn btn-primary" id="addButton">Afegir</button></a>
@endsection
