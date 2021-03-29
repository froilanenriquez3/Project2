{{-- Page template for menu for each user  --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.headerLinks')

    <link rel="stylesheet" href="{{ asset('../resources/css/homePages/home.css?' . rand()) }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/navbar.css?'. rand()) }}">

    @yield('links')

    <title>@yield('title')</title>
</head>
<body>

    <main>
        <header>
            <div id="navHolder">
                {{-- import for navbar --}}
                @yield('navbar')
            </div>
        </header>

        @yield('content')
    </main>
    @include('partials.scripts')
    <script src="https://kit.fontawesome.com/b87b71c2a9.js" crossorigin="anonymous"></script>

</body>
</html>
