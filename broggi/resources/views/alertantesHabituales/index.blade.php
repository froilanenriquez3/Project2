@extends('templates/index')

@section('links')
<link rel="stylesheet" href="{{ asset('../resources/css/alertants/alertantsIndex.css?' . rand()) }}">
@endsection

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
        <td>{{ $alertant->tipus_alertants_id }}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
  <div id="tableNav">
    {{ $alertants->links() }}
</div>


@endsection
