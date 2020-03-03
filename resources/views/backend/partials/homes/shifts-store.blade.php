<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-cubes fa-3x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> Profesionales  </span>
                    <h2 class="font-bold">{{$professionals}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-group fa-3x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> Clientes  </span>
                    <h2 class="font-bold">{{$clients}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-send-o fa-3x"></i>
                </div>
                <div class="col-8 text-right">
                    <span>Turnos disponibles</span>
                    <h2 class="font-bold">{{$aviable_shifts}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3" style="cursor:pointer!important;" id="shiftsCanvasListener">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-bar-chart-o fa-3x"></i>
                </div>
                <div class="col-8 text-right">
                    <span>Turnos cancelados</span>
                    <h2 class="font-bold">{{$canceled_shifts}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 hidden" id="orderCanvas">
    <div class="ibox center ">
        <div class="ibox-title">
            <h5>Turnos disponibles / cancelados </h5>
        </div>
        <div class="ibox-content">
            <div><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                <canvas id="myChart" height="296" width="635"
                        style="display: block; width: 635px; height: 296px;">
                </canvas>
            </div>
        </div>
    </div>
</div>
