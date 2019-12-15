<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="/">GENESIS</a>
            <div class="navbar-header page-scroll">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link page-scroll" href="#page-top">Home</a></li>
                    <li><a class="nav-link page-scroll" href="#store">Tienda</a></li>
                    <li><a class="nav-link page-scroll" href="#team">Equipo</a></li>
                    @auth
                        <li>
                            <a
                                href="/perfil"
                                class="nav-link"
                                >Mi perfil</a>
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
                        <li>
                            <a
                           href="#registerModal"
                           class="nav-link"
                           data-toggle="modal">Registrarme</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</div>
