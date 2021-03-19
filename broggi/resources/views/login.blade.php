<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css') }}" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href=" {{ asset('../css/bootstrap.min.css')}}">
    <link rel="stylesheet" href=" {{ asset('../resources/css/login.css?'.rand()) }}">

    <title>Broggi</title>
</head>
<body>

    <section class="container-fluid" id="ambulanceHalf">
        <img src=" {{ asset('img/ambulaciaColor.svg') }} " alt="Ambulance" id="ambulance">
    </section>

    <section class="container-fluid" id="loginBox">
        <img src=" {{ asset('img/logo1.svg') }}" alt="Logo" id="logo">

        <form action="">

            <div class="loginInputs">
                <label class="" for="username">Usuario</label>
                <input class="" name="username" id="username" type="text">
            </div>

            <div class="loginInputs">
                <label class="" for="contrasenya">Contraseña</label>
                <input class="" name="contrasenya" id="contrasenya" type="password">
            </div>

            <button id="entrarBtn" class="btn btn-primary" type="submit">Entrar</button>
        </form>
    </section>


    <script src="{{ url('https://code.jquery.com/jquery-3.5.1.slim.min.js') }}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js') }}" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
