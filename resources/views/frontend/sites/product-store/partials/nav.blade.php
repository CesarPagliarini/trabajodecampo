<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="/">SGHPS</a>
            <div class="navbar-header page-scroll">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link page-scroll" href="{{route('frontend.home')}}">Home</a></li>
                    @auth
                        <li>
                            <a
                                href="{{route('frontend.client.profile')}}"
                                class="nav-link"
                                >Mi perfil</a>
                        </li>
                        <li>
                            <a
                                href="#cartModal"
                                class="nav-link"
                                data-toggle="modal">
                                <i class="fa fa-cart-arrow-down"></i></a>

                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                 document.getElementById('logout-client-form').submit();"
                            class="nav-link">
                                Cerrar sesion
                            </a>
                            <form id="logout-client-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @else
                        <li>
                            <a
                            href="#loginModal"
                            class="nav-link"
                            data-toggle="modal">Iniciar sesion</a>
                        </li>

                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</div>
