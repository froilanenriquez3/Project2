@extends('templates.index')

@section('title', 'Usuarios')


@section('navbar')
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@endsection

@section('table')

<main-usuarios></main-usuarios>

@endsection

