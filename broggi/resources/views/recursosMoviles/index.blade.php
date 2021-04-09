<<<<<<< HEAD
@extends('templates.indexSideBar')
=======
@extends('templates.components')
>>>>>>> 5fc40b11c12fae5f34040ebaf43c4b648db9ad9c

@section('links')
@endsection

@section('navbar')
    {{-- Navbar admin --}}
    @include('partials.navbarAdmin')
@endsection

<<<<<<< HEAD

@section('title', 'Recursos Moviles')

@section('table')
<main-recursos-moviles></main-recursos-moviles>
@endsection
=======
@section('title', 'Recursos Moviles')

@section('table')
    <container-recursos></container-recursos>
@endsection

>>>>>>> 5fc40b11c12fae5f34040ebaf43c4b648db9ad9c
