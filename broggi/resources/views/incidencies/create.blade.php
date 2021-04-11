@extends('templates.createSideBar')

@section('links')
    <link rel="stylesheet" href=" {{ asset('../resources/css/incidencies/create.css?'.rand()) }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/videoComponent.css?'.rand()) }}">
@endsection

@section('title', 'Formulario de incidencias')


{{-- Navbar teleoperador --}}
@section('navbar')
{{-- Add if for admin navbar --}}
@if(Auth::user()->rols_id == 1)
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@elseif(Auth::user()->rols_id == 2)
{{-- Navbar teleoperador --}}
    @include('partials.navbarTeleoperador')
@endif
@endsection

@section('form')

<video-component></video-component>
<help-box></help-box>
{{-- <container-incidencies></container-incidencies> --}}

{{--
<div class="form-group row">
    <label class="col-2" for="">Numero de incidente</label>
    <input class="col-10" type="number"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Data</label>
    <input class="col-10" type="date"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Hora</label>
    <input class="col-10" type="number"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Telefon Alertant</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Adreca</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Adreca Complement</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Descripcio</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Nom Metge</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Tipus Incidencia</label>
    <select class="col-10" name=""  ></select>
</div>
<div class="form-group row">
    <label class="col-2" for="">Alertant</label>
    <input class="col-10" type="text"  name="">
</div>
 --}}
@endsection

@section('cancelButton')
<a href="{{ url('/incidencies')}}"> <button class="btn ">Cancelar</button></a>
@endsection
