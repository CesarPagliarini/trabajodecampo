<div id="specialties" class="tab-pane  ">
    <div class="panel-body" style="padding-top:25px">
        <div class="ibox">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Selecciona una o varias especialidades.
                        </div>
                        <div class="ibox-content" id="professional_specialty_wrapper">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12" id="specialties_professional_select_wrapper">
                                        <select class="specialties_professional_select form-control" id="specialties_professional_select" multiple="multiple">
                                            @foreach($specialties as $specialty)
                                                <option
                                                    @if($professional->hasSpecialty($specialty->id))
                                                        selected
                                                    @endif

                                                    value="{{$specialty->id}}">{{$specialty->name}}</option>
                                            @endforeach
                                        </select>
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

