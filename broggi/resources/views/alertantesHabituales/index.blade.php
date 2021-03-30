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

@section('title','Alertantes')

@section('table')
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nom</th>
        <th scope="col">Cognom</th>
        <th scope="col">Telefon</th>
        <th scope="col">Adreca</th>
        <th scopr="col">Tipus</th>
      </tr>
    </thead>
    <tbody>
        @foreach($alertants as $alertant)
      <tr>
        <th scope="row">{{ $alertant->id }}</th>
        <td>{{ $alertant->nom }}</td>
        <td>{{ $alertant->cognoms }}</td>
        <td>{{ $alertant->telefon }}</td>
        <td>{{ $alertant->adreca }}</td>
        <td>
            {{ $alertant->tipus_alertants->tipus }}
        </td>
        <td>
            <form
            action="{{ action([App\Http\Controllers\AlertantsController::class, 'edit'], ['alertant' => $alertant->id]) }}"
            method="GET">
            <button class="btn btn-primary" id="editAlertant" type="submit">Editar</button>
            </form>
        </td>
        <td>
            <button class="btn btn-danger" id="deleteAlertant" type="submit" onclick=" $('#deleteAlertantModal{{$alertant->id}}').modal('show');">Esborrar</button>
        </td>
        <alertants-delete :alertant='{{$alertant}}'></alertants-delete>
      </tr>
      @endforeach

    </tbody>
  </table>
  <div id="tableNav">
    {{ $alertants->links() }}
</div>





@endsection
