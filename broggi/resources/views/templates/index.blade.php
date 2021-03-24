{{-- Page template for index of each table page --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap default --}}
    {{-- <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css') }}" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}

    {{-- Bootstrap cyborg --}}
    {{-- <link rel="stylesheet" href=" {{ asset('../resources/css/bootstrap.min.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/all.css') }} ">

    <link rel="stylesheet" href="{{ asset('../resources/css/indexTemplate.css?' . rand()) }}">
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

    <script src="{{ asset('js/app.js') }}"></script>
   {{--  <script src="{{ url('https://code.jquery.com/jquery-3.5.1.slim.min.js') }}"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script> --}}
</body>

</html>
