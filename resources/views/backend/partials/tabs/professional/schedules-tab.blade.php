<div id="schedules" class="tab-pane active show">
    <div class="panel-body" style="padding-top:25px">
        <div class="ibox">
            <div class="row">
                <div class="col-md-3 col-lg-3 float-right">
                    <button class="btn btn-primary dim" type="button"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="ibox">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Selecciona la especialidad
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <select class="middle-select form-control">

                                        @forelse($professional->specialties as $specialty)
                                            <option value="1">{{$specialty->name}}</option>
                                        @empty
                                            <option value="" selected="true" disabled="true">
                                                Aun no tienes especialidades asignadas
                                            </option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Selecciona un rango de fechas
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div id="schedule-interval-container"></div>
                                    <input id="schedule-interval" value="" hidden>
                                </div>
                                <div class="col-md-5">
                                    <select class="select2_demo_2 form-control" multiple="multiple">
                                        <option value="" selected >Lunes</option>
                                        <option value="" selected >Martes</option>
                                        <option value="" selected >Míercoles</option>
                                        <option value="" selected >Jueves</option>
                                        <option value="" selected >Viernes</option>
                                        <option value="" selected >Sabado</option>
                                        <option value="" selected >Domingo</option>
                                        <option value="" selected >Feriados</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@section('custom-scripts')
    <script>
        $.fn.select2.defaults.set('language', 'es');

        $(document).ready(function(){
            $(".middle-select").select2(
                {width: '48%'}
            );
            $(".select2_demo_2").select2(
                {width: '100%'}
            );

            $('#schedule-interval').dateRangePicker({
                    inline:true,
                    container: '#schedule-interval-container',
                    alwaysOpen:true,

            });

        })
    </script>
@endsection
@section('custom-styles')

@endsection
