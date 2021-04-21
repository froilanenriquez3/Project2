@extends('templates.createSideBar')
@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/sidebar.css?' . rand()) }}">
    <link rel="stylesheet" href=" {{ url('../resources/css/alertants/alertantsCreate.css?' . rand()) }}">
@endsection
@section('title', 'Alertantes Habituales Formulario')

@section('navbar')
    {{-- Add if for admin navbar --}}
    @if (Auth::user()->rols_id == 1)
        {{-- Navbar admin --}}
        @include('partials.navbarAdmin')
    @elseif(Auth::user()->rols_id == 2)
        {{-- Navbar teleoperador --}}
        @include('partials.navbarTeleoperador')
    @endif

@endsection

@section('sidebar')
    @include('partials.alSideBar')
@endsection

@section('form')

    <h5 id="formTitle">Alertants</h5>

    @if (isset($alertant))
        <alertants-form :insert='{{ $insert }}' :editedalertant='{{ $alertant }}'></alertants-form>
        {{-- {{ $alertant }} --}}
    @else
        <alertants-form :insert='{{ $insert }}'></alertants-form>
    @endif




@endsection

@section('cancelButton')
    <a href="{{ url('/alertants') }}"> <button class="btn ">Cancelar</button></a>
@endsection
