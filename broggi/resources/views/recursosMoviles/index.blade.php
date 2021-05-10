@extends('templates.components')

@section('links')
<link href="{{ url('https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css')}}" rel='stylesheet' />
 <script src="{{ url('https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js')}}"></script>
<link href="{{ url('https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css')}}" rel="stylesheet"/>
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
    <container-recursos :usertype='{{ Auth::user()->rols_id }}' ></container-recursos>
</div>
@endsection

