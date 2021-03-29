<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white container-fluid fixed-top m-2">

    <a class="logo ml-3" href="#"><img src="{{ asset('img/broggiLogo.png')}}" width="205" height="45"></a>
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
                <a class="nav-link navbarLinks" href="#"><i class="fas fa-home"></i> Inicio </a>
            </li>

            @yield('navbarLinks')


            <!--PERFIL-->

            <li class="nav-cuenta dropdown ml-auto">
                <a id="id-cuenta" class="nav-link dropdown-toggle navbarLinks"  data-toggle="dropdown"  href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-alt"></i> Perfil </a>
                <div class="dropdown-menu bg-primary">
                  <!--<a class="dropdown-item" href="#" style="color: white;"> Editar perfil</a>-->
                  <a class="dropdown-item logout" href="{{ url('/logout')}}" style="color: white;"><i class="fas fa-sign-out-alt"></i> Salir </a>
                </div>
            </li>


        </ul>

      <!--fin derecho-->

    </div>
</nav>

