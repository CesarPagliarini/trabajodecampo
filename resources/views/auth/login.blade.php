@extends('layouts.panel')

@section('application')
    <body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">R+</h1>
            </div>
            <h3>Bienvenido a Genesis</h3>
            <p>Inicia sesión para utilizar la herramienta.</p>
            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Usuario" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <a  href="{{ route('password.request') }}"><small>Olvido su contraseña?</small></a>
            </form>
            <p class="m-t"> <small>see us in github</small> </p>
        </div>
    </div>
    </body>
@endsection
