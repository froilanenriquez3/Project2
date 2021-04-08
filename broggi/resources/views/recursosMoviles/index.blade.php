@extends('templates.indexSideBar')

@section('links')
@endsection

@section('navbar')
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@endsection


@section('title', 'Recursos Moviles')

@section('table')
<main-recursos-moviles></main-recursos-moviles>
@endsection
