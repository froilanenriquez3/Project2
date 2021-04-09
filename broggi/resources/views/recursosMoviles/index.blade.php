@extends('templates.components')

@section('links')
@endsection

@section('navbar')
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@endsection

@section('title', 'Recursos Moviles')

@section('table')
    <div id="app">
    <container-recursos></container-recursos>
</div>
@endsection

