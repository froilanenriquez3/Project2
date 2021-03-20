<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap cyborg --}}
    <link rel="stylesheet" href=" {{ asset('../resources/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('../resources/css/createTemplate.css?' . rand()) }}">

    <title>@yield('title')</title>
</head>

<body>
    <header>
        <nav>
            {{-- import for navbar --}}
            <p>temporary</p>
        </nav>
    </header>

    <aside>
        {{-- import for sidebar --}}
        <p>temporary</p>
    </aside>

    <main>
        <div id="divModoFormacion">
            <p>Modo formacion</p>
            <label class="switch" id="btnModoFormacion">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </div>


        <section id="formSection">
            <div id="divForm">
                @yield('form')
            </div>

        </section>


    </main>

    <script src="{{ url('https://code.jquery.com/jquery-3.5.1.slim.min.js') }}"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>
