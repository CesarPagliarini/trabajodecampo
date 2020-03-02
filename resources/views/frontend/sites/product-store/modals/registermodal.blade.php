<!-- Modal -->
<div class="modal inmodal" tabindex="-1" id="registerModal">
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
                                <form class="m-t" id="registerForm">
                                    <input type="hidden" id="registerUrl" value="{{route('frontend.clients.register')}}">
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control"
                                               placeholder="Nombre"
                                               name="name"
                                               id="registerName"
                                               required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email"
                                               class="form-control"
                                               name="email"
                                               id="registerEmail"
                                               placeholder="Email"
                                               required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                               class="form-control"
                                               name="password"
                                               id="registerPassword"
                                               placeholder="Password"
                                               required="">
                                    </div>
                                    <button id="registerButton" class="btn btn-primary block full-width m-b">Crear cuenta</button>
                                </form>
                                <div id="registerLoading" class="hidden">
                                    @include('frontend.sites.product-store.partials.spinner')
                                </div>
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
