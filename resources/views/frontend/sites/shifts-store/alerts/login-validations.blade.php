
@if(! Session::get('error_in_register'))
    @if($errors->has('email') || $errors->has('password'))
        <script>
            $(document).ready(() => { $('#loginHandler').trigger('click') })
        </script>
        <div class=" error-login">
            Error en credenciales, intente nuevamente.
        </div>
    @endif

    @if($errors->has('status_0') )
        <script>
            $(document).ready(() => { $('#loginHandler').trigger('click') })
        </script>
        <div class="error-login">
            No existe el usuario en nuestros registros o el mismo se encuentra inactivo.
        </div>
    @endif
@endif

@if($errors->has('name') || $errors->has('last_name') || $errors->has('email')|| $errors->has('password'))
    <script>
        $(document).ready(() => { $('#registerHandler').trigger('click') })
    </script>
    <div class=" error-login">
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    </div>
@endif



