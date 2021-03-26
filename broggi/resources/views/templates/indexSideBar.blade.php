{{-- Page template for index of each table page --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.headerLinks')

    <link rel="stylesheet" href="{{ asset('../resources/css/indexTemplateSB.css?' . rand()) }}">

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
            <nav>
                {{-- import for navbar --}}
                <p>temporary</p>
            </nav>
        </header>

        <section id="tableSection">
            <div id="filterSection">
                <p>Filters</p>
            </div>

            <div id="divTable">
                <p>Table</p>
                @yield('table')
            </div>

        </section>


    </main>

    @include('partials.scripts')
</body>

</html>
