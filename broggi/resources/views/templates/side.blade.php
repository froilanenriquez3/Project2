<!-- SIDEBAR -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <!-- BOOTSTRAP -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/side.css">


<!-- INICIO SIDEBAR-->
    <div class="nav-side my-5 pt-5 col-2 position-absolute fixed-top sticky-left align-items-center" style="top:0;">
        <div id="logoSide" class="align-items-center col-2">
            <img src="{{ asset('img/asideLogo.png')}}" class="align-items-center" height="128,15" width="170">
        </div>
        <div class="mt-5">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <!-- align-items-center -->
                <ul id="side-menu nav-pills" class="nav flex-column " >
                    <!--Todo -->
                    <li class="sidebar mb-2">
                        <a  class="nav-link active"  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-home" aria-selected="true"> Todo </a>
                    </li>
                    <!--Alertante  -->
                    <li class="sidebar mb-2">
                        <a  class="nav-link "  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-home" aria-selected="true"> Alertante </a>
                    </li>
                    <!--Incidente-->
                    <li class="sidebar mb-2">
                        <a  class="nav-link"  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-profile" aria-selected="false"> Incidente </a>
                    </li>
                    <!--Afectadx-->
                    <li class="sidebar mb-2">
                        <a  class="nav-link"  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-messages" aria-selected="false"> Afectadx </a>
                    </li>
                    <!--Recursos-->
                    <li class="sidebar mb-2">
                        <a  class="nav-link"  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-settings" aria-selected="false"> Recursos </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--FIN SIDEBAR-->

<body>

</body>
<!--Añadimos Scripts-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<!-- FONTAWESOME -->
<script src="https://kit.fontawesome.com/b87b71c2a9.js" crossorigin="anonymous"></script>

</html>
