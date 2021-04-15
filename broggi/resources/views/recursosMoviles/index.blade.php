@extends('templates.components')

@section('links')
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
@endsection

@section('title', 'Recursos Moviles')

@section('table')
    <div id="app">
    <container-recursos></container-recursos>
</div>
@endsection

