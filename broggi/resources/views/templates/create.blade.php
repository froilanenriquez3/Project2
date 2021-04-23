<!DOCTYPE html>
<html lang="ca">

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



        <section id="formSection">
            <div id="divForm" class="container-fluid">
                <div id="app">
                    @yield('form')
                </div>

            </div>
            <div id="formButtons">
                @yield('cancelButton')

                <button class="btn btn-primary" id="formSubmit" >Afegir</button>
            </div>

        </section>

        @yield('footer')
    </main>


    @include('partials.scripts')
</body>

</html>
