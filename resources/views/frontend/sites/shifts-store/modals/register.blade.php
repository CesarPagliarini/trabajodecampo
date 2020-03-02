<div class="modal fade bd-example-modal-lg" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row" style="padding:25px!important;">
                <div class="col-md-8 offset-2">
                    <div class="row justify-content-center">
                        <div class="col-md-10 ftco-animate fadeInUp ftco-animated">
                            <form class="appointment-form" role="form" method="POST" action="{{ route('frontend.register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                   value="{{old('register_email')}}"
                                                   name="register_email"
                                                   id="appointment_name" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control"
                                                   id="appointment_email"
                                                   name="register_password"
                                                   value="{{old('register_password')}}"
                                                   placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                   id="appointment_email"
                                                   name="register_name"
                                                   value="{{old('register_name')}}"
                                                   placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                   id="appointment_email"
                                                   name="register_last_name"
                                                   value="{{old('register_last_name')}}"
                                                   placeholder="Apellido">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Registrarme" class="btn btn-primary">
                                </div>
                            </form>
                            <div class="row mt-4">
                                <div class="col-md-12 text-center">
                                    @include('frontend.sites.shifts-store.alerts.login-validations')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
