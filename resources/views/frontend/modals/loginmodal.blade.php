<!-- Modal -->
<div class="modal inmodal" tabindex="-1" id="loginModal">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="gray-bg">
                <div class="loginColumns animated fadeInDown">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="font-bold">Bienvenido a Genesis</h2>

                            <p>
                                Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                            </p>

                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>

                            <p>
                                When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </p>

                            <p>
                                <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                            </p>

                        </div>
                        <div class="col-md-6">
                            <div class="ibox-content">

                                <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group {{$errors->has('email') ? "has-error" : ""}}">
                                        <input type="email"
                                               class="form-control "
                                               name="email"
                                               value="{{old('email')}}"
                                               placeholder="Email"
                                               required="">
                                    </div>
                                    <div class="form-group {{$errors->has('password') ? "has-error" : ""}}">
                                        <input type="password"
                                               class="form-control"
                                               name="password"
                                               placeholder="Password"
                                               required="">
                                    </div>
                                    @if($errors->has('email')) @endif
                                    <div class="row buttons-login">
                                        <button type="submit" class="btn btn-primary  m-b">Login</button>
                                        <button type="button" class="btn btn-primary m-b cancel-button"
                                                style="margin-left:5%!important;"
                                                data-dismiss="modal">Close</button>
                                    </div>
                                    <a  href="{{ route('password.request') }}"><small>Olvido su contraseña?</small></a>
                                </form>

                                @include('frontend.alerts.login-validations')
                                <p class="m-t">
                                    <small>Genesis proyect &copy; 2019</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-6">
                            Genesis proyect
                        </div>
                        <div class="col-md-6 text-right">
                            <small>© 2019-2020</small>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div>
</div>
