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

      <tr>
        <th scope="row">1</th>
        <td>John</td>
        <td>Doe</td>
        <td>407-968-1977</td>
        <td>3505 Peach Blossom</td>
        <td>Habitual</td>
      </tr>

    </tbody>
  </table>


@endsection
