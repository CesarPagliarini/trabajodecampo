@extends('layouts.content-panel')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="widget style1 lazur-bg">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-cubes fa-3x"></i>
                    </div>
                    <div class="col-8 text-right">
                        <span> Productos  </span>
                        <h2 class="font-bold">{{$products}}</h2>
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
                        <span> Clientes activos </span>
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
                        <span>Entregados</span>
                        <h2 class="font-bold">{{$delivered}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="widget style1 lazur-bg">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-bar-chart-o fa-3x"></i>
                    </div>
                    <div class="col-8 text-right">
                        <span>Ordenes</span>
                        <h2 class="font-bold">{{$totalOrders}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="ibox center ">
            <div class="ibox-title">
                <h5>Ordenes de pedido </h5>
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
@endsection

@section('custom-scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
        const reporter = "{{route('backend.reports')}}";
    </script>

    <script>


        $(document).ready(()=>{
            const token = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': token}
            });
            $.ajax({
                type: "POST",
                url: "reports",
                data: {
                    'endpoint':'forCanvas',
                    _method:'POST',
                    'resource':'sale-order',
                },
                success:  function (response) {
                    let dataset = [];
                    let labels = [];
                    response.forEach((item) => {
                        dataset.push(item.quantity);
                        labels.push(item.name);
                    })
                    let item = {'dataset': dataset, 'labels': labels};
                    $(document).trigger('instanceChart', [ { item }]);
                }
            });
        });

        $(document).bind('instanceChart', function(e, obj) {
            let item = obj.item;
            const dataset = item.dataset;
            const labels = item.labels
            let ctx = document.getElementById('myChart');
            let myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad de ordenes',
                        data: dataset,
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Chart.js Bar Chart'
                        },
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                max: 5,
                                min: 0,
                                stepSize: 1
                            }
                        }]
                    }
                }
            });
        });

    </script>

@endsection
@section('custom-styles')

    <style>
        .box-custom{
            background-color: #2f4050!important;
        }
    </style>


@endsection
