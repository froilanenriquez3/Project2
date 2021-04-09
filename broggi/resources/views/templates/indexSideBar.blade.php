{{-- Page template for index of each table page --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.headerLinks')

<<<<<<< HEAD
    <link rel="stylesheet" href="{{ asset('../resources/css/indexTemplateSB.css?' . rand()) }}">
=======
    {{-- <link rel="stylesheet" href="{{ asset('../resources/css/indexTemplateSB.css?' . rand()) }}"> --}}
    <link rel="stylesheet" href="{{ asset('../resources/css/sidebar.css?' . rand()) }}">
>>>>>>> 5fc40b11c12fae5f34040ebaf43c4b648db9ad9c

    @yield('links')

    <title>@yield('title')</title>
</head>

<body>
<<<<<<< HEAD

    <aside>
        {{-- Modify --}}
        @include('templates.sideBar')
=======
    <div id="app">
    <aside>
        {{-- Modify --}}
        {{-- @include('templates.sideBar') --}}
        @yield('sidebar')
>>>>>>> 5fc40b11c12fae5f34040ebaf43c4b648db9ad9c
    </aside>

    <main>
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
<<<<<<< HEAD
            <div id="app">
                @yield('table')
            </div>
            </div>
=======

                @yield('table')
            </div>

>>>>>>> 5fc40b11c12fae5f34040ebaf43c4b648db9ad9c

        </section>


    </main>
<<<<<<< HEAD

=======
</div>
>>>>>>> 5fc40b11c12fae5f34040ebaf43c4b648db9ad9c
    @include('partials.scripts')
</body>

</html>
