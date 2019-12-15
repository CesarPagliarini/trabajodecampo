
@if($errors->has('email') || $errors->has('password'))
    <script>
        $(document).ready(() => { $('#loginModal').modal() })
    </script>
    <div class=" error-login">
        Error en credenciales, intente nuevamente.
    </div>
@endif


@if($errors->has('status_0') )
    <script>
        $(document).ready(() => { $('#loginModal').modal() })
    </script>
    <div class="error-login">
        No existe el usuario en nuestros registros o el mismo se encuentra inactivo.
    </div>
@endif
