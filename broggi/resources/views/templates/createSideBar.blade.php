<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.headerLinks')

    @yield('links')
    <link rel="stylesheet" href="{{ asset('../resources/css/side.css?'.rand())}}">
    <link rel="stylesheet" href="{{ asset('../resources/css/createTemplateSB.css?' . rand()) }}">
    <title>@yield('title')</title>
</head>

<body>

    <aside>
        @include('templates.sideBar')
    </aside>

    <main id="app">
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
                @yield('form')
            </div>
            <div id="formButtons">
                @yield('cancelButton')

                 <button class="btn btn-primary" id="formSubmit" >Siguiente</button>
             </div>

        </section>


    </main>

    @include('partials.scripts')

</body>

</html>
