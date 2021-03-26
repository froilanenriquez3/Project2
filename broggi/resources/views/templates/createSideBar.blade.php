<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.headerLinks')

    <link rel="stylesheet" href="{{ asset('../resources/css/createTemplateSB.css?' . rand()) }}">

    @yield('links')

    <title>@yield('title')</title>
</head>

<body>

    <aside>
        {{-- import for sidebar --}}
        <p>temporary</p>
    </aside>



    <main>
        <header>
            <nav id="navbarHolder">
                {{-- import for navbar --}}
                <p>temporary</p>
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
                @yield('form')
            </div>
            <div id="formButtons">
                <button class="btn ">Cancelar</button>
                <button type="submit" id="formSubmit" class="btn btn-primary" form="form">Siguiente</button>
            </div>

        </section>


    </main>

    @include('partials.scripts')
</body>

</html>
