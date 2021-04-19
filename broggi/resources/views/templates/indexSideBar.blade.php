{{-- Page template for index of each table page --}}
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.headerLinks')

    {{-- <link rel="stylesheet" href="{{ asset('../resources/css/indexTemplateSB.css?' . rand()) }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('../resources/css/indexTemplateSB.css?' . rand()) }}"> --}}
    <link rel="stylesheet" href="{{ asset('../resources/css/sidebar.css?' . rand()) }}">

    @yield('links')

    <title>@yield('title')</title>
</head>

<body>
    <div id="app">
        <aside>
            {{-- Modify --}}
            {{-- @include('templates.sideBar') --}}
            @yield('sidebar')
        </aside>

        <main id="indexSBMain">
            <header>
                <nav id="navbarHolder">
                    @yield('navbar')
                </nav>
            </header>

            <section id="tableSection">
                <div id="filterSection">
                    <p>Filters</p>
                </div>

                <div id="divTable">
                    <div id="app">
                        @yield('table')
                    </div>
                </div>

            </section>


        </main>
    </div>
    @include('partials.scripts')
</body>

</html>
