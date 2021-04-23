<div class="nav-side my-5 pt-5 col-2 position-absolute fixed-top sticky-left align-items-center" style="top:0;">
    <div id="logoSide" class="align-items-center col-2">
        <img src="{{ asset('img/asideLogo.png')}}" class="align-items-center" height="128,15" width="170">
    </div>
    <div class="mt-5">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!-- align-items-center -->
            <ul id="side-menu nav-pills" class="nav flex-column " >

                <li class="sidebar mb-2">
                    <a  class="nav-link" href="{{ url('/alertants') }}" > Alertants Habituals </a>
                </li>

                <li class="sidebar mb-2">
                    <a  class="nav-link"  href="{{ url('/tipusalertants') }}" > Tipus d'alertants </a>
                </li>

            </ul>
        </div>
    </div>
</div>
