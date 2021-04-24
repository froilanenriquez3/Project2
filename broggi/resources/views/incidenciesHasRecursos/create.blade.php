@extends('templates.create')

@section('title', 'Incidencia Recursos Formulario')

@section('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/incidenciesRecursos/incidenciesRecursos.css?' . rand()) }}">
@endsection

@section('navbar')
    {{-- Add if for admin navbar --}}
    @if (Auth::user()->rols_id == 1)
        {{-- Navbar admin --}}
        @include('partials.navbarAdmin')
    @elseif(Auth::user()->rols_id == 3)
        {{-- Navbar teleoperador --}}
        @include('partials.navbarRecursos')
    @endif
@endsection

@section('form')
    <incidencies-recursos :userrecursoid='{{ $recursosId }}'></incidencies-recursos>
@endsection

@section('footer')
    <footer class="container">
        <div class="row">
            <p class="col-1">
                <a href="https://validator.w3.org/check?uri=referer">
                    <img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0!" height="31"
                        width="88" /></a>
            </p>
            <p class="col-1">
                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                    <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                        alt="Valid CSS!" />
                </a>
            </p>
            <p class="col-1">
                <a href="https://www.w3.org/WAI/WCAG2AA-Conformance" title="Explanation of WCAG 2 Level AA conformance">
                    <img height="32" width="88" src="https://www.w3.org/WAI/wcag2AA-blue" alt="Level AA conformance,
                    W3C WAI Web Content Accessibility Guidelines 2.0">
                </a>
            </p>
        </div>
    </footer>
@endsection
