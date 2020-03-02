<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{route('frontend.home')}}"><span class="flaticon-scissors-in-a-hair-salon-badge"></span>Sissors Fire</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span>
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{route('frontend.home')}}" class="nav-link">Home</a></li>
                @auth
                <li class="nav-item"><a href="{{route('frontend.shifts')}}" class="nav-link">Turnos</a></li>
                <li class="nav-item"><a href="{{route('frontend.profile')}}" class="nav-link">Mi perfil</a></li>
                @endauth
                <li class="nav-item"><a href="{{route('frontend.galery')}}" class="nav-link">Galeria</a></li>
                <li class="nav-item"><a href="{{route('frontend.about.us')}}" class="nav-link">Conocenos</a></li>
                @if(!Auth::user())
                <li class="nav-item"><a id="loginHandler" class="nav-link">Iniciar sesion</a></li>
                <li class="nav-item"><a id="registerHandler" class="nav-link">Registrarse</a></li>
                @else
                    <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-client-form').submit();"
                       class="nav-link">
                        Cerrar sesion
                    </a>
                        <form id="logout-client-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
