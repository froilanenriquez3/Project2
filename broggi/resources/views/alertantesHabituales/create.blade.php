@extends('templates.create')
@section('links')
    <link rel="stylesheet" href=" {{ url('../resources/css/alertants/alertantsCreate.css?'.rand()) }}">
@endsection
@section('title','Alertantes Habituales Formulario')
@section('form')

<h5 id="formTitle">Alertants</h5>


<form action="{{ action([App\Http\Controllers\AlertantsController::class,'store']) }}" method="POST" id="form">

    <div class="form-group row">
        <label class="col-2" for="alertantTelefon">Telefon</label>
        <input class="col-10" type="text" id="alertantTelefon" name="alertantTelefon">
    </div>
    <div class="form-group row">
        <label class="col-2" for="alertantNom">Nom</label>
        <input class="col-10" type="text" id="alertantNom" name="alertantNom">
    </div>
    <div class="form-group row">
        <label class="col-2" for="alertantCognom">Cognoms</label>
        <input class="col-10" type="text" id="alertantCognom" name="alertantCognom">
    </div>
    <div class="form-group row">
        <label class="col-2" for="alertantAdreca">Adreca</label>
        <input class="col-10" type="number" id="alertantAdreca" name="alertantAdreca">

    </div>


</form>


@endsection
