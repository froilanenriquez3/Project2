<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <!-- BOOTSTRAP -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/navbar.css">

    <title>@yield('title')</title>
</head>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white container-fluid fixed-top m-2">

    <a class="logo ml-3" href="#"><img src="../../../public/broggiLogo.png" width="205" height="45"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02 ">
        <!--inicio izquierdo-->

        <!-- fin izquierdo-->

        <!--Inicio derecho my-2 my-lg-0-->
        <ul class="navbar-nav ml-auto mr-3">
            <!--Inicio-->
            <li class="nav-inicio  mr-2 ">
                <a class="nav-link" href="#"><i class="fas fa-home"></i> Inicio </a>
            </li>
            <!--Nueva incidencias-->
            <li class="nav-incidencias mr-2">
                <a class="nav-link" style=":hover {color: yellow}" href="#"><i class="fas fa-plus-circle"></i> Nueva incidencia </a>
            </li>
            <!--Incidencias-->
            <li class="nav-usuaris mr-2">
                <a class="nav-link" href="#"><i class="fas fa-exclamation-triangle"></i> Incidencias </a>
            </li>
            <!--Alertantes habituales-->
            <li class="nav-habituales mr-2">
                <a class="nav-link" href="#"><i class="fas fa-users"></i> Alertantes habituales </a>
            </li>
            <!--Recursos móviles-->
            <li class="nav-recursos mr-2">
                <a class="nav-link " href="#"><i class="fas fa-ambulance"></i> Recursos móviles </a>
            </li>

            <!--PERFIL-->

            <li class="nav-cuenta dropdown ml-auto">
                <a id="id-cuenta" class="nav-link dropdown-toggle"  data-toggle="dropdown"  href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-alt"></i> Perfil </a>
                <div class="dropdown-menu bg-primary">
                  <!--<a class="dropdown-item" href="#" style="color: white;"> Editar perfil</a>-->
                  <a class="dropdown-item" href="#" style="color: white;"><i class="fas fa-sign-out-alt"></i> Salir </a>
                </div>
            </li>




        </ul>

      <!--fin derecho-->

    </div>
</nav>

<body>

</body>
<!--Añadimos Scripts-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<!-- FONTAWESOME -->
<script src="https://kit.fontawesome.com/b87b71c2a9.js" crossorigin="anonymous"></script>

</html>
