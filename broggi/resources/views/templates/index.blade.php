{{-- Page template for index of each table page --}}
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.headerLinks')

    <link rel="stylesheet" href="{{ asset('../resources/css/indexTemplate.css?' . rand()) }}">
    @yield('links')
    <link rel="icon" href="{{ asset('logoWeb.ico') }}" sizes="32x32" type="ico">
    <title>@yield('title')</title>
</head>

<body>


    <main id="app">
        <header>
            <nav id="navbarHolder">
                @yield('navbar')
            </nav>
        </header>

        <section id="tableSection">

            <div id="divTable">
                <div>
                    @yield('table')
                </div>
            </div>

            @yield('addButton')


        </section>
    </main>

    @include('partials.scripts')
</body>

</html>
