<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
  /*TODO
   *    Cuando envío una solicitud GET a la ruta login,
   *    entonces debería devolver la vista auth.login.
   * */
//vendor/bin/phpunit tests/Feature/Http/Controllers/Auth/LoginControllerTest.php

    public function testView()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }
//
//    /* TODO
//        Cuando realizo una solicitud de tupo POST a la URL login,
//        dado que he enviado credenciales no válidas,
//        me redirigen nuevamente a la página de inicio de sesión
//        y recibo un error de validación.
//


    public function testLogin()
    {
        $response = $this->post(route('login'), []);
        $response->assertStatus(302);
        $this->assertTrue(false);
        $response->assertSessionHasErrors('password');
    }







}
