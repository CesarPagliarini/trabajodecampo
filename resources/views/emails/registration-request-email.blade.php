<div class="content">
    <table class="main" width="100%" cellpadding="0" cellspacing="0">
        <tbody><tr>
            <td class="content-wrap">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td class="content-block">
                            <h3>Bienvenido {{$client->name}}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block">
                            Nos pone muy felices que decidas utilizar nuestra plataforma, confirma tu cuenta
                            y accede a los mejores servicios.
                            <br>
                            te esperamos en Genesis!
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block">
                            Si no has solicitado crear una cuenta, ignora este mensaje
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block aligncenter">
                            <a href="{{route('frontend.clients.email.confirmation', ['token'=>$client->email_verification_token])}}" class="btn-primary">Confirmar dirección de correo</a>
                        </td>
                    </tr>
                    </tbody></table>
            </td>
        </tr>
        </tbody></table>
    <div class="footer">
        <table width="100%">
            <tbody><tr>
                <td class="aligncenter content-block">Genesis <a href="#">Inc.</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
