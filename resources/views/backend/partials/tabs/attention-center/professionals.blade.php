<div id="professionals" class="tab-pane ">
    <div class="panel-body" style="padding-top:25px">
        <div class="ibox">
            <div class="row">
                @forelse($attention_place->professionals as $professional)
                <div class="col-lg-4">
                    <div class="contact-box center-version">
                        <a href="{{route('professionals.edit', ['id'=>$professional->id])}}">
                            <img alt="image" class="rounded-circle" src="{{asset('img/random/pain.jpg')}}">
                            <h3 class="m-b-xs"><strong>{{$professional->name}}</strong></h3>
                            <h5 class="m-b-xs"><strong>{{$professional->last_name}}</strong></h5>
                            <br>
                            @if(! empty($professional->highlighted_specialty))
                                <div class="font-bold">{{$professional->highlighted_specialty->specialty->name}}</div>
                            @endif

                            <address class="m-t-md">
                                <strong>{{$professional->cel_phone}}</strong><br>
                                {{$professional->address}}<br>
                                {{$professional->city}}<br><br>

                                {{$professional->birthDay}}<br>

                            </address>
                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a href="" class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Llamar </a>
                                <a href="" class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <col-lg-12 class="col-md-12">
                        <div class="alert alert-success">
                            Este centro de atencion no tiene profesionales todavia
                            <a class="alert-link" href="#">
                                Cada profesional debe darse de alta.
                            </a>
                        </div>
                    </col-lg-12>
                @endforelse
            </div>

        </div>
    </div>

    @section('custom-scripts')

    @endsection
    @section('custom-styles')

    @endsection
</div>
