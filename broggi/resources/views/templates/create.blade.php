<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.headerLinks')

    <link rel="stylesheet" href="{{ asset('../resources/css/createTemplate.css?' . rand()) }}">

    @yield('links')

    <title>@yield('title')</title>
</head>

<body>

    <main >
        <header>
            <nav id="navbarHolder">
                @yield('navbar')
            </nav>
        </header>


        <div id="divModoFormacion">
            <p>Modo formacion</p>
            <label class="switch" id="btnModoFormacion">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </div>


        <section id="formSection">
            <div id="divForm" class="container-fluid">
                <div id="app">
                    @yield('form')
                </div>

            </div>
            <div id="formButtons">
               <a href="{{ url('/alertants')}}"> <button class="btn ">Cancelar</button></a>
                <button class="btn btn-primary" id="formSubmit" >Siguiente</button>
            </div>

        </section>


    </main>

    @include('partials.scripts')
</body>

</html>
